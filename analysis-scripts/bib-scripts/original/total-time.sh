#!/bin/bash
file=$1
/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/gettime -T $file | tr '\t' '~' | cut -d '~' -f2