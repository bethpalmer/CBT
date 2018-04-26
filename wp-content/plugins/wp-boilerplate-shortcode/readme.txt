 === WP Boilerplate Shortcode ===
 Contributors: Mike Schinkel
 Donate Link: http://www.charitywater.org/donate/
 Tags: boilerplate, shortcode
 Requires at least: 3.0
 Tested up to: 3.0
 Stable tag: 1.0.3

 Provides a shortcode that when inserted will display the body from a referenced "boilerplate" post type.

 == Description ==
 This plugin provides a shortcode that when inserted will display the body from a referenced "*boilerplate*." A boilerplate is a special post type defined by this plugin. References can be made by title, path or ID. Below is a list of shortcode attributes used by the boilerplate shortcode. Examples are given for hypothetical "*Copyright*" and "*Payment Terms.*" All attributes are optional except one of "*byid*", "*bypath*" or "*bytitle*" must be specified:

  * **bytitle**: The full case-sensitive title of the boilerplate, i.e. "*Copyright*" or "*Payment Terms*"

  * **bypath**: The editable lowercase path for the boilerplate, i.e. "*copyright*" or "*payment-terms*" (vs. "*/boilerplates/copyright/*" or "*/boilerplates/payment-terms/*")

  * **byid**: Refers to the internal ID from the wp_posts table for the boilerplate post, i.e. 234 or 1273

  * **showtitle**: "*true*" or "*false*" (defaults to "*false*"); if "*true*" boilerplate content will be prefixed with the title of the boilerplate as entered in the edit screen, or optionally with a "*title*" attribute you specify.

  * **title**: Use to override the displayed title of the boilerplate in specific cases. When "*title*" is specified "*showtitle*" is implicity set to "*true*."

  * **titletag**: HTML element used to wrap the title when "*showtitle*" is explicity "*true*" or "*title*" is set (defaults to "*h3*.")

  * **id**: The HTML "*id*" attribute applied to the div element that wraps the boilerplate and it's optional title. If not specificed the div will not get have an "*id*" set.

  * **class**: The HTML "*class*" attribute applied to the div& element that wraps the boilerplate and it's optional title (defailts to "*boilerplate*.")

 == Installation ==

 To install the WP Boilerplate Shortcode plugin do the following steps:

 **Manual Installation from a Direct Download:**

<ol>
<li>Download the plugin.</li>
<li>Unzip the plugin's .ZIP file.</li>
<li>Create a sub directory off your WordPress site's root named wp-content/plugins/wp-boilerplate-shortcode/ on your web host.</li>
<li>Upload the plugin's file to the sub directory just created at your web host.</li>
<li>Login to your WordPress admin console.</li>
<li>Select the Plugin's "*Edit*" option which generates a listing of plugins.</li>
<li>Activate this plugin.</li>
</ol>

 **Automatic Installation from within the Admin Console:**

<ol>
<li>Login to your WordPress admin console.</li>
<li>Select "<em>Add New</em>" from the plugins menu.</li>
<li>Search for "<em>wp boilerplate shortcode</em>."</li>
<li>Select the plugin and click "<em>Install</em>."</li>
<li>After installation is complete click "<em>Activate</em>."</li>
</ol>

 Once you've completed either the manual or automatic installation then you can either use the `boilerplate` shortcode or the `the_boilerplate()` template tag. See the [FAQ](http://wordpress.org/extend/plugins/wp-boilerplate-shortcode/faq/) for instructions on how to use the shortcode and/or the template tag.

== Frequently Asked Questions ==

= Where do add/edit my boilerplates? =

Look on the left sidebar in your WordPress admin after you've activated the plugin for a menu called "*Boilerplates*."

= Can you give me examples of using the shortcode? =

 Sure. Here are some simple examples:

<ul>
<li><pre> [boilerplate bytitle="Payment Terms"]<pre></li>
<li><pre> [boilerplate bypath="copyright"]<pre></li>
<li><pre> [boilerplate byid="971"]<pre></li>
</ul>

 Here are some more complex examples:

<ul>
<li><pre> [boilerplate bytitle="Payment Terms" showtitle="true" title="Terms for Payment" titletag="strong" id="terms"]<pre></li>
<li><pre> [boilerplate bypath="copyright" class="boilerplate copyright"]<pre></li>
</ul>

 = Where do I type the shortcode? =

 Type the shortcode into the body of any page, of any post, or of any custom post type where you want the boilerplate processed.

 = Does this plugin provide a boilerplate template tag? =

 Yes:
<ol>
 <li><pre>the_boilerplate('contact-methods'); // 'contact-methods' = the path of the boilerplate.</pre></li>
 <li><pre>the_boilerplate('Contact Methods','title'); // 'Contact Methods' = the title of the boilerplate.</pre></li>
 <li><pre>the_boilerplate(123,'id',array('showtitle'=>'true')); // 123 = boilerplate's post ID.</pre></li>
</ol>

 The array parameter in example #3 can contain any <a href="..">of these attributes</a>
 = After Adding/Editing a Boilerplate if I click "<em>View</em>" I get an error. Why? =

 If you are still getting this error it's because WordPress still hasn't addressed this problem.

 We decided to disallow boilerplates to be seen directly via a URL and as such when you try to view them WordPress tell you you cannot see it.

 An example URL that you might see (assuming you were on the domain `example.com` and had a boilerplate called "*Copyright*") might be as follows:

 `http://example.com/boilerplates/copyright/`

 <em><strong>This URL will not work</strong></em> because boilerplates do not get a page of their own.

 Hopefully WordPress will address this soon and you'll be able to view your boilerplates from within the admin console.

 = What's the syntax for the shortcode/template tag? =

 If you are into things from a technical persective it looks like this (angles <> indicate placeholders, a vertical bar | indicates "*or*", elipsees indicate one or more, parens indicate grouping, and braces {} indicate optional):

<ul>
<li><p><strong>Shortcode</strong>:</p>
<p><pre>[boilerplate (bytitle|bypath|byid)="(<title>|<path>|<id>)"
   {showtitle="(true|false)"} {title="<title>"} {titletag="<html-tag>"}
   {id="<id>"} {class="<class1 class2 ...>}]</pre></p>
</li></ul>

For the template tag the parens are not needed for grouping and the square brackets indicate optional, which is what most docs use for optional, when it doesn't conflict with actual syntax:

<ul>
<li><p><strong>Template Tag</strong>:</p>
<p><pre>the_boilerplate(<title>|<path>|<id> [, 'path'|'title'|'id']
   [, array(['showtitle'=> 'true'|false',] ['title' => '<title>',]
   ['titletag' => '<html-tag>',] ['id' => '<id>',] ['class' => '<class1 class2 ...>',] ));</pre></p>
</li></ul>

== Upgrade Notice ==

 No upgrade notice needed, yet.

 == Screenshots ==

1. Editing Boilerplates in the WordPress admin.
2. The example "*Copyright*" boilerplate with shortcode attribute callouts.
3. Inserting the "*Copyright*" shortcode into a post.
4. Output of the "*Copyright*" shortcode on the web.
5. Use of `the_boilerplate()` template tag.
6. The example "*Payment Terms*" boilerplate for reference.
7. Inserting the "*Payment Terms*" shortcode into a post using most of the shortcode's attributes.
8. Output of the "*Payment Terms*" shortcode on the web.


 == ChangeLog ==

 = 1.0.2 =
  * Screenshots!

 = 1.0.1 =
  * Added `the_boilerplate()` template tag.
  * Restructured `readme.txt` and added FAQ items and more detailed installation instructions.
  * Moved code structure to an encapsulated `WPBoilerplateShortcode` class with class methods instead independent functions.

 = 1.0 =
  * Initial release.

