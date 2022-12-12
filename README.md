# Cogdog Auto Embed Extras WordPress Plugin

by Alan Levine [cog.dog](https://cog.dog)

This plugin  extends the variety of media sites whose content can be auto embedded by pasting a URL in the editor-- you know the way you can paste in the URL for any YouTube video and it automatically embeds in the editor (and when published). It is more of a proof of concept, and any WordPress coder up to the task could pull out code as needed for their own theme work.

If this is new to you, for your own sake, see [all the media sites WordPress supports natively](https://wordpress.org/support/article/embeds/). 
 
The Embed Extras plugin adds a few more into the mix. Why bother with this?

1. HTML embed codes are messy. They have to be pasted into the text editor (WordPress running in Classic mode) or the HTML block.
2. Even if you can figure this out, it's all for naught if your site is hosted in a WordPress multisite (the iframe tags of most embed codes are stripped out)
3. It's much easier to paste in one URL and be done
4. It feels magical when embedded media just appears after pasting in a URL

Much of this emerged from development of the WordPress SPLOTbox theme, this just generalizes things so it works anywhere in WordPress editing.

I hope.

## Installation

This will work on self-hosted WordPress sites where you can install your own plugins or themes.  

1. [Download this plugin](https://github.com/cogdog/wp-embed-extras/archive/refs/heads/master.zip) using the Green via the **Code** button above, use the Download as ZIP option.
2. In your dashboard, go to **Plugs** then click **Add New** and finally the **Upload Plugin** button.
3. Activate the plugin through the 'Plugins' menu in WordPress




## Supported Service

The following sites can be auto embedded from a URL in the WordPress Editor, Classic or the Block Editor. Just paste the web address for any content from the sites below on a new blank line, and press ENTER (or RETURN). The media should appear in the visual editor

### Padlet (padlet.com)

All content published on Padlet can be automatically embedded by pasting in the URL for any published, public padlet content, for example `https://padlet.com/beckydono/48x1o4i4gi1s`

### Internet Archive (archive.org)

Embeds support for Audio, Video, Texts, even their collection of software.

* `https://archive.org/details/atari_2600_frogger_1982_parker_brothers_ed_english_david_lamkins_pb5300`
* `https://archive.org/details/artofknitting00butt`
* `https://archive.org/details/Jolly_Fish_1932`
* `https://archive.org/details/AMFM2019-02-09`

### Vocaroo Audio
Any audio recorded on (Vocaroo)[https://vocaroo.com] in either URL format `https://voca.ro/1nE0WWUqhxlN` or `https://vocaroo.com/1nRPpQCPhQ4M`

### Sodaphonic Boombox
Another nifty web recordingediting tool, embed [audio recorded into Boonbox](https://sodaphonic.com/boombox) or edited with the [Sodaphonic Editor](https://sodaphonic.com/editor). Examples.

* `https://sodaphonic.com/audio/344uhz2j8NUJjyUkckQq`

## History

* Dec 11, 2022: Returned to add support for Vocaroo and Sodaphonic. H5P ones removed, host sites are too picky about frame sharing. Cleaned up some functions and regex.
* Mar 7, 2020: The idea emerges and test version shared [It Takes More Magic Than a Saw to Support WordPress Media Embeds](https://cogdogblog.com/2020/03/magic-wordpress-media-embeds/) (CogDogBlog.com)
* Mar 16, 2020: First version (v .15)


-----
*If this kind of stuff has any value to you, please consider supporting me so I can do more!*

[![Support me on Patreon](http://cogdog.github.io/images/badge-patreon.png)](https://patreon.com/cogdog) [![Support me on via PayPal](http://cogdog.github.io/images/badge-paypal.png)](https://paypal.me/cogdog)

----- 


