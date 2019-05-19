#!/bin/bash

file=$1

#reads file:
opened=$(cat $file)

#converts file:
bash /Applications/MAMP/htdocs/NewTestings/hum2mid "$opened" -o file.mid