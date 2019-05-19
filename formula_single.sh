#!/bin/bash

songfile=$1
comparefile=$2


function percentError() {
    val1=$1
    val2=$2

    if (( $(echo "$val1 > $val2" | bc -l) )); then
        echo "scale=5;1-((${val1}-${val2})/${val1})" | bc -l
    else
        echo "scale=5;1-((${val2}-${val1})/${val2})" | bc -l
    fi

}

percentError $1 $2