#!/bin/bash
file=$1
outputfile=$2
cat $file | bash /var/www/html/analysis-scripts/humdrum/deg/deg > $outputfile