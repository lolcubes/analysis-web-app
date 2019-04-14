#!/bin/bash

numberfiles=$(ls /Applications/MAMP/htdocs/NewTestings/Array_Lists | wc -l)

numberoutput=$(echo "$numberfiles +1" | bc -l)
echo $numberoutput | grep . | tr -d '\n'