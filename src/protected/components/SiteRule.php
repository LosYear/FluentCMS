<?php
class SiteRule extends CBaseUrlRule
{
    public $connectionID = 'db';
    
    
    public function createUrl($manager, $route, $params, $ampersand)
    {
        if ($route === 'page/view') {
            return $params['id'];
        }
        return false; // не применяем данное правило
    }
    
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        if (preg_match('%^(\w+)?$%', $pathInfo, $matches)) {
            $row = Yii::app()->db->createCommand(array(
                'select' => array(
                    'id',
                    'url',
                    'type'
                ),
                'from' => '{{node}}',
                'where' => 'url=:url',
                'params' => array(
                    ':url' => $matches[1]
                )
            ))->queryRow();
            
            $_GET['id'] = $row["id"];
            
            return "{$row["type"]}/view";
        }
        return false; // не применяем данное правило
    }
}
?>