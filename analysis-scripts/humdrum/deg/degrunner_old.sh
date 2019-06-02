#!/bin/bash
file=$1
outputfile=$2
cat $file | bash /Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg > $outputfile