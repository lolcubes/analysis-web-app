#!/bin/bash
dir=/Applications/MAMP/htdocs/NewTestings/Song_Database
result=

for i in $(ls $dir); do
    currentComp=$(cat "${dir}/${i}/time-info/composer.txt")
    result="${result}${currentComp}\n"
    name="${name}${i}_${currentComp}\n"
done

dirs=$(printf $result | sort | uniq -c | cut -d ' ' -f4)
len=$(echo "$dirs" | wc -l)
name=$(printf $name)


function averageScales {
    echo "$1" | wc -l
}






# FOR ALL THE COMPOSERS:
for j in $(seq 1 $len); do  
    line=$(echo "$dirs" | sed "${j}q;d")
    averagesDir="/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}"
    echo $line

    read=$(echo "$name" | grep $line)

    # STARTS A LOOP FOR EACH SONG IN CERTAIN COMPOSER
    scales=
    while read nameLine; do
        nameLine=$(echo $nameLine | sed "s/_[^_]*$//")

        while read amalgLine; do
            amalgName=$(echo $amalgLine | cut -d ':' -f1)

            if [ "$amalgName" == "scales" ]; then
                scales="$scales$amalgLine\n"
            fi
        done < "/Applications/MAMP/htdocs/NewTestings/Song_Database/$nameLine/data/amalgamated.txt"
    done <<< "$read"
    scales=$(printf $scales)
    averageScales "$scales"
done