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

function averageNoteValue {
    num=$(echo "$1" | wc -l)
    averagePitch=$(echo "$1" | tr ';' '\n' | grep . | cut -d ':' -f2 |  grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    echo "average-note-value:$(echo "$averagePitch / $num" | bc -l);"
}

function averageSteps {
    num=$(echo "$1" | wc -l)
    first=$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    second=$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f2 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    third=$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f3 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    
    first=$(echo $first / $num | bc -l)
    second=$(echo $second / $num | bc -l)
    third=$(echo $third / $num | bc -l)

    echo "average-steps:${first};${second};${third}"
}

function averageRepeatedPitches {
    num=$(echo "$1" | wc -l)

    one=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    two=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f2 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    three=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f3 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    four=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f4 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    five=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f5 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    six=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f6 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    seven=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f7 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    
    echo "repeated-pitches:${one};${two};${three};${four};${five};${six};${seven}"
}

function averageRepeatedNoteValue {
    num=$(echo "$1" | wc -l)

    one=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    two=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f2 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    three=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f3 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    four=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f4 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    five=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f5 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    six=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f6 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    seven=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f7 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)
    eight=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f8 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc) / $num " | bc -l)

    echo "repeated-note-value:${one};${two};${three};${four};${five};${six};${seven};${eight}"
}
function mostUsedNoteValue {
    num=$(echo "$1" | wc -l)
    one=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    two=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f2 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    three=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f3 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    four=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f4 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    five=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f5 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    six=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f6 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    seven=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f7 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    eight=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f8 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    nine=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f9 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    ten=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f10 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
   
    echo "most-used-note-value:${one};${two};${three};${four};${five};${six};${seven};${eight};${nine};${ten}"

}

function mostUsedPitches {
    num=$(echo "$1" | wc -l)
    one=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f1 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    two=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f2 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    three=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f3 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    four=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f4 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    five=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f5 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    six=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f6 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    seven=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f7 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    eight=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f8 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    nine=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f9 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
    ten=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d ';' -f10 | grep .  | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num " | bc -l)
   
    echo "most-used-pitches:${one};${two};${three};${four};${five};${six};${seven};${eight};${nine};${ten}"
}

function averageTimeSignature {
    num=$(echo "$1" | wc -l)
    top=$(echo "scale=3;$(echo "$1" | cut -d ':' -f2 | cut -d '/' -f1 | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)
    bottom=$(echo "scale=3;$(echo "$1" | cut -d '/' -f2 | tr -d ';' | grep . | tr '\n' '+' | rev | cut -c 2- | rev | bc -l) / $num" | bc -l)

    echo "time-signature:$top/$bottom;"

}

function averageKeySignature {
    num=$(echo "$1" | wc -l)
    average=$(echo "$(echo "$1" | tr -d ';' | cut -d ':' -f2 | grep . | tr '\n' '+' | rev | cut -c 2- | bc -l) / $num" | bc -l)
    if [ -z $average ]; then
        echo "key-signature:0;" 
    else 
        echo "key-signature:$average;"
    fi
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
    avNoteValue=
    avSteps=
    repPitch=
    repNV=
    mUNV=
    mUP=
    timeSignature=
    keySignature=
    while read nameLine; do
        nameLine=$(echo $nameLine | sed "s/_[^_]*$//")

        while read amalgLine; do
            amalgName=$(echo $amalgLine | cut -d ':' -f1)

            if [ "$amalgName" == "scales" ]; then
                scales="$scales$amalgLine\n"
            elif [ "$amalgName" == "average-pitch" ]; then
                avPitch="$avPitch$amalgLine\n"
            elif [ "$amalgName" == "average-note-value" ]; then
                avNoteValue="$avNoteValue$amalgLine\n"
            elif [ "$amalgName" == "average-steps" ]; then
                avSteps="$avSteps$amalgLine\n"
            elif [ "$amalgName" == "repeated-pitches" ]; then
                repPitch="$repPitch$amalgLine\n"
            elif [ "$amalgName" == "repeated-note-value" ]; then
                repNV="$repNV$amalgLine\n"
            elif [ "$amalgName" == "most-used-note-value" ]; then
                mUNV="$mUNV$amalgLine\n"
            elif [ "$amalgName" == "most-used-pitches" ]; then
                mUP="$mUP$amalgLine\n"
            elif [ "$amalgName" == "time-signature" ]; then
                timeSignature="$timeSignature$amalgLine\n"
            elif [ "$amalgName" == "key-signature" ]; then
                keySignature="$keySignature$amalgLine\n"
            fi

        done < "/Applications/MAMP/htdocs/NewTestings/Song_Database/$nameLine/data/amalgamated.txt"
    done <<< "$read"

    scales=$(printf $scales)
    averageScales "$scales" > "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    avPitch=$(printf $avPitch)
    averagePitch "$avPitch" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    avNoteValue=$(printf $avNoteValue)
    averageNoteValue "$avNoteValue" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    avSteps=$(printf $avSteps)
    averageSteps "$avSteps" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"

    repPitch=$(printf $repPitch)
    averageRepeatedPitches "$repPitch" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    repNV=$(printf $repNV)
    averageRepeatedNoteValue "$repNV" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"

    mUNV=$(printf $mUNV)
    mostUsedNoteValue "$mUNV" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    mUP=$(printf $mUP)
    mostUsedPitches "$mUP" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"
    
    timeSignature=$(printf $timeSignature)
    averageTimeSignature "$timeSignature" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"

    keySignature=$(printf $keySignature)
    averageKeySignature "$keySignature" >> "/Applications/MAMP/htdocs/NewTestings/Song_Database_Averages/composers/${line}/data.txt"

done