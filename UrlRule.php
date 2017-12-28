<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/28/2017
 * Time: 3:37 PM
 */

namespace quangthinh\yii\route;


use quangthinh\yii\route\models\Route;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\base\BaseObject;
use yii\db\Connection;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRuleInterface;

/**
 * Class UrlRule
 * @package quangthinh\yii\route
 *
 * Chú ý không nên sử dụng kèm với một số CompositeUrlRule khác
 */
class UrlRule extends BaseObject implements UrlRuleInterface
{
    public $routeClass = 'quangthinh\yii\route\models\Route';

    /**
     * Parses the given request and returns the corresponding route and parameters.
     * @param UrlManager $manager the URL manager
     * @param Request $request the request component
     * @return array|bool the parsing result. The route and the parameters are returned as an array.
     * If false, it means this rule cannot be used to parse this path info.
     */
    public function parseRequest($manager, $request)
    {
        /**
         * @var $routeClass Route
         */
        $routeClass = $this->routeClass;

        /**
         * @var $data Route
         */
        $data = $routeClass::parse($request);

        if ($data) {
            $params = $data->getParams();
            return [$data->route_name, $params];
        }

        return false;
    }

    /**
     * Creates a URL according to the given route and parameters.
     * Một số thủ thuật:
     *      Dựa vào bộ tham số route và params tìm ra Url thông qua ObjectId tương ứng với tham số đã cấu hình
     *
     * @param UrlManager $manager the URL manager
     * @param string $route the route. It should not have slashes at the beginning or the end.
     * @param array $params the parameters
     * @return string|bool the created URL, or false if this rule cannot be used for creating this URL.
     */
    public function createUrl($manager, $route, $params)
    {
        /**
         * @var $routeClass Route
         */
        $routeClass = $this->routeClass;

        /**
         * @var $model Route
         */
        $model = $routeClass::tryCreate($route, $params);

        if ($model) {
            return $model->getUrl($params);
        }

        return false;
    }
}
