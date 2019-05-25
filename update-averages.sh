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

    num=$(echo "$1" | wc -l)
    ascSing2Sum=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSing3Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f2 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSing4Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f3 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSing5Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f4 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSing6Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f5 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSing7Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f6 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascSingLargestSum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f7 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    
    ascDoub2Sum=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f8 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoub3Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f9 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoub4Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f10 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoub5Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f11 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoub6Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f12 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoub7Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f13 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    ascDoubLargestSum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f14 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
 
    descSing2Sum=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f15 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSing3Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f16 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSing4Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f17 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSing5Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f18 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSing6Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f19 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSing7Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f20 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descSingLargestSum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f21 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)

    descDoub2Sum=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f22 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoub3Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f23 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoub4Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f24 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoub5Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f25 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoub6Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f26 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoub7Sum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f27 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    descDoubLargestSum=$(echo "scale=3;$(echo "$1" | cut -d ';' -f28 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)

    printf "scales:${ascSing2Sum};${ascSing3Sum};${ascSing4Sum};${ascSing5Sum};${ascSing6Sum};${ascSing7Sum};${ascSingLargestSum};${ascDoub2Sum};${ascDoub3Sum};${ascDoub4Sum};${ascDoub5Sum};${ascDoub6Sum};${ascDoub7Sum};${ascDoubLargestSum};${descSing2Sum};${descSing3Sum};${descSing4Sum};${descSing5Sum};${descSing6Sum};${descSing7Sum};${descSingLargestSum};${descDoub2Sum};${descDoub3Sum};${descDoub4Sum};${descDoub5Sum};${descDoub6Sum};${descDoub7Sum};${descDoubLargestSum};\n"
    # echo "scale=4;$sum / $num" | bc -l

}

function averagePitch {
    num=$(echo "$1" | wc -l)
    averagePitch=$(echo "$1" | tr ';' '\n' | grep . | cut -d ':' -f2 |  grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    echo "average-pitch:$(echo "$averagePitch / $num" | bc -l);"
}




# FOR ALL THE COMPOSERS:
for j in $(seq $len); do  
    line=$(echo "$dirs" | sed "${j}q;d")
    averagesDir="/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}"
    mkdir $averagesDir
    echo $line

    read=$(echo "$name" | grep $line)

    # STARTS A LOOP FOR EACH SONG IN CERTAIN COMPOSER
    scales=
    avPitch=
    while read nameLine; do
        nameLine=$(echo $nameLine | sed "s/_[^_]*$//")

        while read amalgLine; do
            amalgName=$(echo $amalgLine | cut -d ':' -f1)

            if [ "$amalgName" == "scales" ]; then
                scales="$scales$amalgLine\n"
            elif [ "$amalgName" == "average-pitch" ]; then
                avPitch="$avPitch$amalgLine\n"
            fi
        done < "/Applications/MAMP/htdocs/NewTestings/Song_Database/$nameLine/data/amalgamated.txt"
    done <<< "$read"

    scales=$(printf $scales)
    averageScales "$scales" > "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    avPitch=$(printf $avPitch)
    averagePitch "$avPitch" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"

done