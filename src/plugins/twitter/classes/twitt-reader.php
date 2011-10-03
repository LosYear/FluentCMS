<?php
/**
 * TwittReader - PHP class for displaying last twits on your site.
 *
 * @copyright  2009 Pelesh Yaroslav aka Tokolist http://tokolist.com
 * @license    http://www.gnu.org/licenses/lgpl.html  LGPL
 * @version    1.0 Beta
 * @link       http://code.google.com/p/twittreader/
 */

class TwittReader {

    /**
     * Cache file path
     * @var string
     */
    public $cacheFile = 'twitter.txt';

    /**
     * Period while chache is actual (in seconds)
     * @var int
     */
    public $cachePeriod = 1800; // in seconds

    /**
     * Twitter server availability timeout in seconds
     * @var int
     */
    public $timeout = 5; //in seconds

    /**
     * Maximum count of twits to show (1-9)
     * @var int
     */
    public $twittsMaxCount = 9;

    /**
     * Template for twitt with [status], [link] and [date] variables
     * @var string
     */
    public $twittWrapper = "<li><p>[status]</p><p><a href=\"[link]\">[date]</a></p></li>\n";

    /**
     * Date format for [date] variable
     * @var string
     */
    public $dateFormat = 'd.m.Y H:i:s';

    /**
     * Service not available error message
     * @var string
     */
    public $errorNotAvailable = 'Service not available.';

    /**
     * No user statuses error message
     * @var string
     */
    public $errorNoStatuses = 'No statuses found for this user.';

    /**
     * cURL additional options if needed
     * @var array
     */
    public $curlOptions = array();

    /**
     * Outer charset of twits
     * @var string
     */
    public $charset = FALSE;

    /**
     * Highlight URLs in twits
     * @var bool
     */
    public $highlightUrls = FALSE;

    /**
     * Highlight e-mails in twits
     * @var bool
     */
    public $highlightEmails = FALSE;

    /**
     * Highlight users in twits
     * @var bool
     */
    public $highlightUsers = FALSE;

    /**
     * Highlight hashtags in twits
     * @var bool
     */
    public $highlightHashtags = FALSE;

    /**
     * Feed url for chosen user name
     * @var string
     */
    private $feedUrl;

    /**
     * Constructor
     * @param string $userName Name of user to display twits of
     */
    function __construct($userName) {
        $this->feedUrl = 'http://twitter.com/statuses/user_timeline/' . $userName . '.rss';
    }

    /**
     * Returns twits of specified in constructor user or error message if
     * an error occurred
     * @return string
     */
    public function getTwitts() {
        if ($this->isCacheActual()) {
            return $this->getCached();
        } else {
            if ($data = $this->getFresh()) {
                $this->cacheData($data);
                return $data;
            } elseif($data = $this->getCached()) {
            	return $data;
            } else {
            	return $this->errorNotAvailable;
            }
        }
    }

    /**
     * Clears chache
     */
    public function clearCache() {
        return unlink($this->cacheFile);
    }

    /**
     * Returns TRUE if chache exists and actual or FALSE otherwise
     * @return bool
     */
    private function isCacheActual() {
        return ($this->cachePeriod > 0)
            && (file_exists($this->cacheFile))
            && (time() - filemtime($this->cacheFile) < $this->cachePeriod);
    }

    /**
     * Writes specified string in chache file
     * @param string $data String to chache
     */
    private function cacheData($data) {
        $hfile = fopen("tmp/".$this->cacheFile, 'w');
        fwrite($hfile, $data);
        fclose($hfile);
    }


    /**
     * Reads and returns chached twits from chache file or FALSE on error
     * @return string|bool
     */
    private function getCached() {
        if (file_exists($this->cacheFile)) {
            $hFile = fopen("tmp/".$this->cacheFile, 'r');
            $data = fread($hFile, filesize($this->cacheFile));
            fclose($hFile);
            return $data;
        } else {
            return FALSE;
        }
    }

    /**
     * Callback function for URLs regexp replace
     * @param array $matches Matches of URL regexp
     * @return string
     */
    private static function pregReplaceUrls($matches) {
    	$url = '';
        switch ($matches[3]) {
      	    case 'www.':
      	        $url .= 'http://';
      	        break;
      	    case 'ftp.':
      	        $url .= 'ftp://';
      	        break;
      	    default:
      	}

      	$url .= $matches[2];

      	$title = $matches[2];

      	if (strlen($title) > 27) {
      	    $title = substr($title, 0, 27) . '...';
        }

    	return $matches[1]
    	    . '<a href="' . $url . '">'
    	    . $title
    	    . '</a>';
    }

    /**
     * Callback function for hashtags regexp replace
     * @param array $matches Matches of hashtag regexp
     * @return string
     */
    private static function pregReplaceHashtags($matches) {
    	return $matches[1]
    	    . '<a href="http://twitter.com/search?q=' . urlencode($matches[2]) . '">'
    	    . $matches[2]
    	    . '</a>';
    }

    /**
     * Returns processed RSS of specified in constructor user from Twitter.
     * Returns FALSE or error message if an error occured
     * @return string|bool
     */
    private function getFresh() {
        $ch = curl_init($this->feedUrl);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->setCurlOptions($ch, $this->curlOptions);


        $feedData = curl_exec($ch);
        curl_close($ch);

        if (empty($feedData)) {
            return FALSE;
        }

        $dom = new DOMDocument();
        if (!$dom->loadXML($feedData)) {
        	return FALSE;
        }

        $items = $dom->getElementsByTagName('item');

        if ($items->length < 1) {
            return $this->errorNoStatuses;
        }

        $data = '';
        for ($i = 0; $i < $items->length; $i++) {
            if ($i > $this->twittsMaxCount - 1) {
                break;
            }


            // Title
            $title = $items->item($i)->getElementsByTagName('title')->item(0)->nodeValue;
            $title = substr($title, strpos($title, ': ') + 2);

            if ($this->highlightUrls) {
                $title = preg_replace_callback('/(^|\s)((((https?|ftp):\/\/)|((www|ftp)\.))([^\s]+)?)(?<![,\.])/iu', 'TwittReader::pregReplaceUrls', $title);
            }

            if ($this->highlightEmails) {
                $title = preg_replace('/(^|\s)[^@\s]+@{1}[^@\s]+/iu', '$1<a href="mailto:$0">$0</a>', $title);
            }

            if ($this->highlightUsers) {
                $title = preg_replace('/(^|\s)@([a-zA-Z0-9_]{1,20})/iu', '$1@<a href="http://twitter.com/$2">$2</a>', $title);
            }

            if ($this->highlightHashtags) {
                $title = preg_replace_callback('/(^|\s)(#([a-zA-Z0-9_]+))/iu', 'TwittReader::pregReplaceHashtags', $title);
            }

            if ($this->charset) {
                $title = iconv('UTF-8', $this->charset, $title);
            }


            // Date
            $pubDate = $items->item($i)->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $pubDate = date($this->dateFormat, strtotime($pubDate));


            // Link
            $link = $items->item($i)->getElementsByTagName('link')->item(0)->nodeValue;


            // Twitt completely
            $twitt = $this->twittWrapper;
            $twitt = str_replace('[status]', $title, $twitt);
            $twitt = str_replace('[date]', $pubDate, $twitt);
            $twitt = str_replace('[link]', $link, $twitt);

            $data .= $twitt;
        }

        return $data;
    }


    /**
     * Simulation of curl_setopt_array() for better compatibility
     * @param resource &$ch cURL handle
     * @param array $curlOptions CURL options array in Option => Value format
     */
    private function setCurlOptions(&$ch, $curlOptions) {
        foreach ($curlOptions as $option => $value) {
            curl_setopt($ch, $option, $value);
        }
    }

}
