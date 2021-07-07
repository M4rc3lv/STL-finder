# STL-finder
Visually find STL-files on your local hard drive.

When you download, create or print a lot of STL files it is hard to keep track of what kind of 3d objects you have. With this tool you can inspect a folder to see what STL files are there.

It works by a local PHP instance (php -S localhost:8099) to show the files in a folder. There is also a Nemo (Linux Mint's file manager) script to jump to the STL-finder from within Nemo.

![afbeelding](https://user-images.githubusercontent.com/19297663/124710307-ddd85800-defc-11eb-8457-7f79a9c5d06e.png)

**Installation**
Put the contents of Site somewhere and start it with a local PHP server or edit (and then use) the shell script in the Nemo folder.
The site depends on an OpenScad executable (named OpenSCAD-2021.01-x86_64.AppImage), so put that executable in the root of the site.

