#!/bin/bash

file=$1
catter=$(cat $file)
bash /Applications/MAMP/htdocs/NewTestings/hum2mid "$catter" -o file.mid