# unHYPED Wordpress Theme

Custom Wordpress theme for [unHYPED](http://unhyped.com), based on [SYN–ACK Wordpress Boilerplate](https://github.com/frebro/synack-wpbp).

## Components

* [Ruby](http://www.ruby-lang.org/)
* [Rake](http://rake.rubyforge.org/)
* [Guard](https://rubygems.org/gems/guard)
* [Guard shell](http://rubygems.org/gems/guard-shell)
* [Closure compiler](http://code.google.com/closure/compiler/)
* [Sass](http://sass-lang.com/)
* [Compass](http://compass-style.org/)

## How to use

1. Install into /wp-content/themes/
2. Activate theme
3. Set a static front page to display events (you can set blog to another page, e.g. /blog/)


## How to develop

In Terminal app:

Run __bundle__ to install all dependencies.

Run __guard__ to handle Closure and Compass compilation automatically when you save files (you can always do it manually with __rake__ and __compass compile__).