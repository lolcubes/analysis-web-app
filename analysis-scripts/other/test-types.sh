function testTypes {
    lineNum=$(cat $1 | wc -l)

    while read line; do
        binValue="${binValue}"`cat $2 | grep $line | wc -l`"\n"
    done < $1

    matchNum=$(printf "$binValue" | tr '\n' '+' | tr -d ' ' | rev | cut -c 2- | rev | bc -l)

    if [ $lineNum -eq $matchNum ]; then
        echo match!
    else
        echo  no match
    fi

}

testTypes $1 $2