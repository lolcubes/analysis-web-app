#!/bin/bash

directory=/Applications/MAMP/htdocs/NewTestings/Song_Database 
foldercount=$(ls $directory | wc -l)
echo "$foldercount+1" | bc -l | grep .
