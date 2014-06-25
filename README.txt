TM2-xaseco2-plugin for showing banners

INSTALLATION:
1) put the plugin.banner.php-file in the xaseco2/plugins-folder
2) in the xaseco2/plugins.xml add the line:
   <plugin>plugin.banner.php</plugin>
3) edit banner.xml-file and put it in the xaseco2-folder
4) restart xaseco2

CONFIGURATION:
you can show up to 3 banners
for every banner shown you need an extra .xml-file
name the first .xml file banner.xml, the second banner2.xml and the third banner3.xml

If you want to use more than 1 banner, you got to un-comment some lines of code in the plugin.banner.php.
The functions:

banner_startup
banner_PlayerConnect
banner_endMap
banner_beginMap

are the functions in which you must un-comment the part concerning banner2 and/or banner3


DIFFERENT BANNER-TYPES:
it is possible, to show either
- a banner, that hovers onMouseOver and leads to a external link when being clicked
or
- a banner, that shows another picture onMouseOver and leads to an external link when being clicked


first possibility is in the example1.xml shown
first possibility is in the example2.xml shown

