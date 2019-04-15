#!/bin/bash
file=$1
a=$(grep '\*MM' $file | cut -c 4-)
echo $a
