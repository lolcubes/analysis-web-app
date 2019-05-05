#!/bin/bash

file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
occurencesOutput="${removed}data/most-used-pitches"

firstOutput="${occurencesOutput}/1.txt"
firstPercent="${occurencesOutput}/Percent_1.txt"

secondOutput="${occurencesOutput}/2.txt"
secondPercent="${occurencesOutput}/Percent_2.txt"

thirdOutput="${occurencesOutput}/3.txt"
thirdPercent="${occurencesOutput}/Percent_3.txt"

fourthOutput="${occurencesOutput}/4.txt"
fourthPercent="${occurencesOutput}/Percent_4.txt"

fifthOutput="${occurencesOutput}/5.txt"
fifthPercent="${occurencesOutput}/Percent_5.txt"


fileprep=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '=' | grep -v '*' | grep -v '!' | tr  "\t" "\n" |  grep . )
totallines=$( echo "$fileprep" | grep -v '\.' | grep -v 'r' | sed '/^$/d' | wc -l)

seven="$(echo "$fileprep" | grep '7' | grep -v '7-' | grep -v '7+' | wc -l)"
sevenminus="$(echo "$fileprep" | grep '7-' | wc -l)"
sevenplus="$(echo "$fileprep" | grep '7+' | wc -l)"
six="$(echo "$fileprep" | grep '6' | grep -v '6-' | grep -v '6+' | wc -l)"
sixminus="$(echo "$fileprep" | grep '6-' | wc -l)"
sixplus="$(echo "$fileprep" | grep '6+' | wc -l)"
five="$(echo "$fileprep" | grep '5' | grep -v '5-' | grep -v '5+' | wc -l)"
fiveminus="$(echo "$fileprep" | grep '5-' | wc -l)"
fiveplus="$(echo "$fileprep" | grep '5+' |  wc -l)"
four="$(echo "$fileprep" | grep '4' | grep -v '4-' | grep -v '4+' | wc -l)"
fourminus="$(echo "$fileprep" | grep '4-' | wc -l)"
fourplus="$(echo "$fileprep" | grep '4+' | wc -l)"
three="$(echo "$fileprep" | grep '3' | grep -v '3-' | grep -v '3+' | wc -l)"
threeplus="$(echo "$fileprep" | grep '3+' | wc -l)"
threeminus="$(echo "$fileprep" | grep '3-' | wc -l)"
two="$(echo "$fileprep" | grep '2' | grep -v '2-' | grep -v '2+' | wc -l)"
twoplus="$(echo "$fileprep" | grep '2+' | wc -l)"
twominus="$(echo "$fileprep" | grep '2-' | wc -l)"
one="$(echo "$fileprep" | grep '1' | grep -v '1-' |  grep -v '1+' |wc -l)"
oneplus="$(echo "$fileprep" | grep '1+' | wc -l)"
oneminus="$(echo "$fileprep" | grep '1-' | wc -l)"
onelowered=$oneminus
oneraised=$((oneplus+twominus))
tworaised=$((twoplus+threeminus))
threeraised=$((threeplus+fourminus))
fourraised=$((fourplus+fiveminus))
fiveraised=$((fiveplus+sixminus))
sixraised=$((sixplus+minus))
sevenraised=$sevenplus


counted=(7+ 7 6+ 6 5+ 5 4+ 4 3+ 3 2+ 2 1+ 1 1-)
array=($sevenraised $seven $sixraised $six $fiveraised $five $fourraised $four $threeraised $three $tworaised $two $oneraised $one $onelowered )
max=${array[0]}
maxindex=0

fourminusount=0
for t in ${array[@]}; do
    if [ "$t" -gt "$max" ]; then
        max=$t
        maxindex=$count
    fi
    count=$(($count+1))
done

a="$(echo "${counted[maxindex]}")"

if [ "$a" -eq 1 ]
then 
    b=$one
elif [ "$a" = 1+ ]
then
    b=$oneraised
elif [ "$a" = 1- ]
then
    b=$onelowered
elif [ "$a" -eq 2 ]
then 
    b=$two
elif [ "$a" = 2+ ]
then
    b=$tworaised
elif [ "$a" -eq 3 ]
then 
    b=$three
elif [ "$a" = 3+ ]
then
    b=$threeraised
elif [ "$a" -eq 4 ]
then 
    b=$four
elif [ "$a" = 4+ ]
then
    b=$fourraised
elif [ "$a" -eq 5 ]
then 
    b=$five
elif [ "$a" = 5+ ]
then
    b=$fiveraised
elif [ "$a" -eq 6 ]
then 
    b=$six
elif [ "$a" = 6+ ]
then
    b=$sixraised
elif [ "$a" -eq 7 ]
then 
    b=$seven
elif [ "$a" = 7+ ]
then
    b=$sevenraised
fi

greatestPercent=$(bc -l <<< $b/$totallines)

if [ "$greatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $a | tr -d '\n' > $firstOutput
    bc -l <<< $b/$totallines | tr -d '\n' > $firstPercent
fi



secondLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '2q;d')

if [ "$secondLargest" -eq $one ]
then 
    secondGreatest=1
elif [ "$secondLargest" = $onelowered ]
then
    secondGreatest=1-
elif [ "$secondLargest" = $oneraised ]
then
    secondGreatest=1+
elif [ "$secondLargest" = $two ]
then
    secondGreatest=2
elif [ "$secondLargest" = $tworaised ]
then
    secondGreatest=2+
elif [ "$secondLargest" = $three ]
then
    secondGreatest=3
elif [ "$secondLargest" = $threeraised ]
then
    secondGreatest=3+
elif [ "$secondLargest" = $four ]
then
    secondGreatest=4
elif [ "$secondLargest" = $fourraised ]
then
    secondGreatest=4+
elif [ "$secondLargest" = $five ]
then 
    secondGreatest=5
elif [ "$secondLargest" = $fiveraised ]
then
    secondGreatest=5+
elif [ "$secondLargest" = $six ]
then 
    secondGreatest=6
elif [ "$secondLargest" = $sixraised ]
then
    secondGreatest=6+
elif [ "$secondLargest" = $seven ]
then 
    secondGreatest=7
elif [ "$secondLargest" = $sevenraised ]
then
    secondGreatest=7+
fi


secondgreatestPercent=$(bc -l <<< $secondLargest/$totallines)

if [ "$secondgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $secondGreatest | tr -d '\n' > $secondOutput
    echo $secondgreatestPercent | tr -d '\n' > $secondPercent 
fi


thirdLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '3q;d')

if [ "$thirdLargest" -eq $one ]
then 
    thirdGreatest=1
elif [ "$thirdLargest" = $onelowered ]
then
    thirdGreatest=1-
elif [ "$thirdLargest" = $oneraised ]
then
    thirdGreatest=1+
elif [ "$thirdLargest" = $two ]
then
    thirdGreatest=2
elif [ "$thirdLargest" = $tworaised ]
then
    thirdGreatest=2+
elif [ "$thirdLargest" = $three ]
then
    thirdGreatest=3
elif [ "$thirdLargest" = $threeraised ]
then
    thirdGreatest=3+
elif [ "$thirdLargest" = $four ]
then
    thirdGreatest=4
elif [ "$thirdLargest" = $fourraised ]
then
    thirdGreatest=4+
elif [ "$thirdLargest" = $five ]
then 
    thirdGreatest=5
elif [ "$thirdLargest" = $fiveraised ]
then
    thirdGreatest=5+
elif [ "$thirdLargest" = $six ]
then 
    thirdGreatest=6
elif [ "$thirdLargest" = $sixraised ]
then
    thirdGreatest=6+
elif [ "$thirdLargest" = $seven ]
then 
    thirdGreatest=7
elif [ "$thirdLargest" = $sevenraised ]
then
    thirdGreatest=7+
fi

thirdgreatestPercent=$(bc -l <<< $thirdLargest/$totallines)

if [ "$thirdgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $thirdGreatest | tr -d '\n' > $thirdOutput
    echo $thirdgreatestPercent | tr -d '\n' > $thirdPercent 
fi


fourthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '4q;d')

if [ "$fourthLargest" -eq $one ]
then 
    fourthGreatest=1
elif [ "$fourthLargest" = $onelowered ]
then
    fourthGreatest=1-
elif [ "$fourthLargest" = $oneraised ]
then
    fourthGreatest=1+
elif [ "$fourthLargest" = $two ]
then
    fourthGreatest=2
elif [ "$fourthLargest" = $tworaised ]
then
    fourthGreatest=2+
elif [ "$fourthLargest" = $three ]
then
    fourthGreatest=3
elif [ "$fourthLargest" = $threeraised ]
then
    fourthGreatest=3+
elif [ "$fourthLargest" = $four ]
then
    fourthGreatest=4
elif [ "$fourthLargest" = $fourraised ]
then
    fourthGreatest=4+
elif [ "$fourthLargest" = $five ]
then 
    fourthGreatest=5
elif [ "$fourthLargest" = $fiveraised ]
then
    fourthGreatest=5+
elif [ "$fourthLargest" = $six ]
then 
    fourthGreatest=6
elif [ "$fourthLargest" = $sixraised ]
then
    fourthGreatest=6+
elif [ "$fourthLargest" = $seven ]
then 
    fourthGreatest=7
elif [ "$fourthLargest" = $sevenraised ]
then
    fourthGreatest=7+
fi

fourthgreatestPercent=$(bc -l <<< $fourthLargest/$totallines)

if [ "$fourthgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $fourthGreatest | tr -d '\n' > $fourthOutput
    echo $fourthgreatestPercent | tr -d '\n' > $fourthPercent 
fi




fifthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '5q;d')

if [ "$fifthLargest" -eq $one ]
then 
    fifthGreatest=1
elif [ "$fifthLargest" = $onelowered ]
then
    fifthGreatest=1-
elif [ "$fifthLargest" = $oneraised ]
then
    fifthGreatest=1+
elif [ "$fifthLargest" = $two ]
then
    fifthGreatest=2
elif [ "$fifthLargest" = $tworaised ]
then
    fifthGreatest=2+
elif [ "$fifthLargest" = $three ]
then
    fifthGreatest=3
elif [ "$fifthLargest" = $threeraised ]
then
    fifthGreatest=3+
elif [ "$fifthLargest" = $four ]
then
    fifthGreatest=4
elif [ "$fifthLargest" = $fourraised ]
then
    fifthGreatest=4+
elif [ "$fifthLargest" = $five ]
then 
    fifthGreatest=5
elif [ "$fifthLargest" = $fiveraised ]
then
    fifthGreatest=5+
elif [ "$fifthLargest" = $six ]
then 
    fifthGreatest=6
elif [ "$fifthLargest" = $sixraised ]
then
    fifthGreatest=6+
elif [ "$fifthLargest" = $seven ]
then 
    fifthGreatest=7
elif [ "$fifthLargest" = $sevenraised ]
then
    fifthGreatest=7+
fi

fifthgreatestPercent=$(bc -l <<< $fifthLargest/$totallines)

if [ "$fifthgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $fifthGreatest | tr -d '\n' > $fifthOutput
    echo $fifthgreatestPercent | tr -d '\n' > $fifthPercent 
fi

sixthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '6q;d')

if [ "$sixthLargest" -eq $one ]
then 
    sixthGreatest=1
elif [ "$sixthLargest" = $onelowered ]
then
    sixthGreatest=1-
elif [ "$sixthLargest" = $oneraised ]
then
    sixthGreatest=1+
elif [ "$sixthLargest" = $two ]
then
    sixthGreatest=2
elif [ "$sixthLargest" = $tworaised ]
then
    sixthGreatest=2+
elif [ "$sixthLargest" = $three ]
then
    sixthGreatest=3
elif [ "$sixthLargest" = $threeraised ]
then
    sixthGreatest=3+
elif [ "$sixthLargest" = $four ]
then
    sixthGreatest=4
elif [ "$sixthLargest" = $fourraised ]
then
    sixthGreatest=4+
elif [ "$sixthLargest" = $five ]
then 
    sixthGreatest=5
elif [ "$sixthLargest" = $fiveraised ]
then
    sixthGreatest=5+
elif [ "$sixthLargest" = $six ]
then 
    sixthGreatest=6
elif [ "$sixthLargest" = $sixraised ]
then
    sixthGreatest=6+
elif [ "$sixthLargest" = $seven ]
then 
    sixthGreatest=7
elif [ "$sixthLargest" = $sevenraised ]
then
    sixthGreatest=7+
fi

sixthgreatestPercent=$(bc -l <<< $sixthLargest/$totallines)

if [ "$sixthgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $sixthGreatest | tr -d '\n' > $sixthOutput
    echo $sixthgreatestPercent | tr -d '\n' > $sixthPercent 
fi


seventhLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '7q;d')

if [ "$seventhLargest" -eq $one ]
then 
    seventhGreatest=1
elif [ "$seventhLargest" = $onelowered ]
then
    seventhGreatest=1-
elif [ "$seventhLargest" = $oneraised ]
then
    seventhGreatest=1+
elif [ "$seventhLargest" = $two ]
then
    seventhGreatest=2
elif [ "$seventhLargest" = $tworaised ]
then
    seventhGreatest=2+
elif [ "$seventhLargest" = $three ]
then
    seventhGreatest=3
elif [ "$seventhLargest" = $threeraised ]
then
    seventhGreatest=3+
elif [ "$seventhLargest" = $four ]
then
    seventhGreatest=4
elif [ "$seventhLargest" = $fourraised ]
then
    seventhGreatest=4+
elif [ "$seventhLargest" = $five ]
then 
    seventhGreatest=5
elif [ "$seventhLargest" = $fiveraised ]
then
    seventhGreatest=5+
elif [ "$seventhLargest" = $six ]
then 
    seventhGreatest=6
elif [ "$seventhLargest" = $sixraised ]
then
    seventhGreatest=6+
elif [ "$seventhLargest" = $seven ]
then 
    seventhGreatest=7
elif [ "$seventhLargest" = $sevenraised ]
then
    seventhGreatest=7+
fi


seventhgreatestPercent=$(bc -l <<< $seventhLargest/$totallines)

if [ "$seventhgreatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo $seventhGreatest | tr -d '\n' > $seventhOutput
    echo $seventhgreatestPercent | tr -d '\n' > $seventhPercent 
fi