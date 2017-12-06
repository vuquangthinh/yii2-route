# Route Helper
UrlBehavior thêm vào behavior của activerecord muốn tạo link
UrlRule để đăng ký url rewrite

Example
Tạo url cho 1 model tương ứng
Thêm vào behavior
 ```
 [
    'class' => UrlBehavior::className(),
    'routeClass' => ArticleRoute::className(),
    'attributeName' => 'slug' // tùy chọn, 
 ],
            
```


Tạo class quản ly route
```
class ArticleRoute extends Route
{
    public static $defaultRoute = 'cms/article/view';
}
```

Thêm vào url manage
```
[
    'class' => UrlRule::className(),
    'routeClass' => ArticleRoute::className(),
]
```

Thêm rule validate cho attribute name slug và sử dụng như 1 property của activerecord
khi crud
```
<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
```




