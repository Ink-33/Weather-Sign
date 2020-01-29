# Weather-Sign
生成带来访者的地理位置(基于IP)，当地实况天气的图片。</br>
效果如下(此处可能会显示Github的地理位置)</br>
<a href="https://weas.quhyu.xyz/" target="_blank"><img src="https://weas.quhyu.xyz/"/></a>
<h2>灵感来源</h2>
本作品灵感源于<a href="https://github.com/xhboke/IP" target="_blank">xhboke/IP</a>，由于原IP签名天气功能并不完善，我就将这个签名独立。完成的差不多后便开个源。
<h2>使用前必读</h2>
本签名档内置的是<a href="https://www.heweather.com/" target="_blank">和风天气</a>的免费接口，使用前请去<a href="https://www.heweather.com/" target="_blank">和风天气</a>申请一个Web API的Key，并填入index.php的58行处，否则将不显示任何天气数据。(详情请见<a href="https://dev.heweather.com/docs/getting-started/" target="_blank">和风天气开发文档</a>)
<h2>其它说明</h2>
1:更换了IP的查询接口，新接口为<a href="https://api.ip.sb/" target="_blank">https://api.ip.sb/</a>，此接口支持识别IPV6地址的地理位置，但返回值为英文(例如ChinaJiangsuNanjing)</br>
2:增加了对使用Cloudflare站点的支持(在index.php中注释对应参数)</br>
3:更换了背景图片与默认字体(现使用的是杨任东竹石体，免费商用)</br>
4:增加了调用量统计功能(<a href="https://weas.quhyu.xyz/countershow.php/" target="_blank">DEMO</a>)</br>
5:我修改后的IP-Sign(<a href="https://github.com/Ink-33/IP-Sign/" target="_blank">传送门</a>)
<h2>我的博客</h2>
<a href="https://www.quhyu.xyz/" target="_blank">水墨凌空工作室</a>
