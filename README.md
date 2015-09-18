## CLI下字符画生成器

#### 使用方法

php $dir/cli/pic2ascii.php IMAGE_URL 

example by:

php $dir/pic2ascii.php http://stor.weixinhost.com/3/wxhost-images/ar_269e67cf0c08d810442d8e278223792ca5306fc7

#### 原理

1. 将图片等比缩略到合适的尺寸
2. 迭代像素，计算每个像素的灰度值
3. 根据灰度值输出内容

