TM2-xaseco2-plugin for showing banners

INSTALLATION:
1) put the plugin.banner.php-file in the xaseco2/plugins-folder
2) in the xaseco2/plugins.xml add the line:
   <plugin>plugin.banner.php</plugin>
3) edit banner.xml-file and put it in the xaseco2-folder
4) restart xaseco2

CONFIGURATION:
you can show as many banners as you wish (tested with 3)
for every banner shown you need an extra .xml-file
adapt in the adapt-section of the plungin.banner.php the name of your xml(s) and
un-comment the lines you may need for more banners (just remove // in front of the line)




DIFFERENT BANNER-TYPES:
it is possible, to show either
- a banner, that hovers onMouseOver and leads to a external link when being clicked
or
- a banner, that shows another picture onMouseOver and leads to an external link when being clicked


first possibility is in the example1.xml shown
second possibility is in the example2.xml shown

(2nd possibility was developed especially for being able to fake round-hover-effect)

