#!/bin/bash

#identifies the database directory
directory=Song_Database 

#counts # of folders
foldercount=$(ls $directory | wc -l)

# adds one to the number of folders
echo "$foldercount+1" | bc -l | grep .