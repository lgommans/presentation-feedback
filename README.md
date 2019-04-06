# Presentation Feedback Tool

Get feedback on your presentations. View the live site:  
https://lgms.nl/p/presentation-feedback

----

When searching for "presentation feedback tool" or something similar, I found
nothing that allowed me to get feedback on a presentation I am going to give
next week. Naturally, I had to create it.

You can use my installation of this software (see link above) for free, or
install a version for yourself.


## Installing

Dependencies:

- MySQL/MariaDB
- Tested with PHP 5.4 and 7.0, but might work with others
  - For all features to work, PHP's `mail()` function should work

Setup:

1. Place all files in a folder on your website.
   (You might want to disallow access to the `.git` folder!)
2. Modify `config.php`.
   (Database setup is automatic, see `dbsetup.php` for which tables are created.)
3. Done!


## Contributing

Contributions of any kind are welcome, particularly on the front of design or
extra features. It's rather basic right now, though that suits my purposes at
the moment.

If there is anyhing you wish to see but cannot make it yourself, let me know
(open an issue) and if I have time, I might be able to write it.

