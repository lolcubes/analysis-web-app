#!/bin/bash
file=$1
a=$(grep '\*M' $file | grep -v 'MM' | cut -c 3-)
echo $a
#if $a=