#!/bin/bash

file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
occurencesOutput="${removed}data/most-used-note-value/occurrences"
mkdir $occurencesOutput

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



timeOutput="${removed}data/most-used-note-value/time"
mkdir $timeOutput

firstTimeOutput="${timeOutput}/1.txt"
firstTimePercent="${timeOutput}/Percent_1.txt"

secondTimeOutput="${timeOutput}/2.txt"
secondTimePercent="${timeOutput}/Percent_2.txt"

thirdTimeOutput="${timeOutput}/3.txt"
thirdTimePercent="${timeOutput}/Percent_3.txt"

fourthTimeOutput="${timeOutput}/4.txt"
fourthTimePercent="${timeOutput}/Percent_4.txt"

fifthTimeOutput="${timeOutput}/5.txt"
fifthTimePercent="${timeOutput}/Percent_5.txt"



fileprep="$(grep -v '=' $file | grep -v '*' | grep -v '!' | tr  "\t" "\n" |  grep . |  grep -o '[[:digit:]]*' | grep .)"

totallines=$(echo "$fileprep" | wc -l)
totaltime=$(echo "$fileprep" | sed 's|^|1/|' | tr '\n' '+' | awk '{print $0"0"}' | bc -l)

one=$(echo "$fileprep" | grep '\b1\b' | wc -l)
onetime=$one
two=$(echo "$fileprep" | grep '\b2\b' | wc -l)
twotime=$( bc -l <<< $two/2)
four=$(echo "$fileprep" | grep '\b4\b' | wc -l)
fourtime=$( bc -l <<< $four/4)
eight=$(echo "$fileprep" | grep '\b8\b' | wc -l)
eighttime=$( bc -l <<< $eight/8)
sixteen=$(echo "$fileprep" | grep '\b16\b' | wc -l)
sixteentime=$( bc -l <<< $sixteen/16)
thirtytwo=$(echo "$fileprep" | grep '\b32\b' | wc -l)
thirtytwotime=$( bc -l <<< $thirtytwo/32)
sixtyfour=$(echo "$fileprep" | grep '\b64\b' | wc -l)
sixtyfourtime=$( bc -l <<< $sixtyfour/64)

array=($one $two $four $eight $sixteen $thirtytwo $sixtyfour)
timearray=($onetime $twotime $fourtime $eighttime $sixteentime $thirtytwotime $sixtyfourtime)

largest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '1q;d')

if [ "$largest" = $one ]
then 
    greatest=1
elif [ "$largest" = $two ]
then
    greatest=2
elif [ "$largest" = $four ]
then
    greatest=4
elif [ "$largest" = $eight ]
then
    greatest=8
elif [ "$largest" = $sixteen ]
then
    greatest=16
elif [ "$largest" = $thirtytwo ]
then
    greatest=32
elif [ "$largest" = $sixtyfour ]
then
    greatest=64
fi


greatestPercent=$(bc -l <<< $largest/$totallines)

if [ "$greatestPercent" -eq "0" ]; then
    echo "test"
else 
    echo "1/$greatest" | tr -d '\n' > $firstOutput
    bc -l <<< $largest/$totallines | tr -d '\n' > $firstPercent
fi

secondLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '2q;d')

if [ "$secondLargest" = $one ]
then 
    secondGreatest=1
elif [ "$secondLargest" = $two ]
then
    secondGreatest=2
elif [ "$secondLargest" = $four ]
then
    secondGreatest=4
elif [ "$secondLargest" = $eight ]
then
    secondGreatest=8
elif [ "$secondLargest" = $sixteen ]
then
    secondGreatest=16
elif [ "$secondLargest" = $thirtytwo ]
then
    secondGreatest=32
elif [ "$secondLargest" = $sixtyfour ]
then
    secondGreatest=64
fi

secondgreatestPercent=$(bc -l <<< $secondLargest/$totallines)

if [ "$secondgreatestPercent" -eq "0" ]; then
    echo "test"

else 
    echo "1/$secondGreatest" | tr -d '\n' > $secondOutput
    bc -l <<< $secondLargest/$totallines | tr -d '\n' > $secondPercent
fi


thirdLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '3q;d')

if [ "$thirdLargest" = $one ]
then 
    thirdGreatest=1
elif [ "$thirdLargest" = $two ]
then
    thirdGreatest=2
elif [ "$thirdLargest" = $four ]
then
    thirdGreatest=4
elif [ "$thirdLargest" = $eight ]
then
    thirdGreatest=8
elif [ "$thirdLargest" = $sixteen ]
then
    thirdGreatest=16
elif [ "$thirdLargest" = $thirtytwo ]
then
    thirdGreatest=32
elif [ "$thirdLargest" = $sixtyfour ]
then
    thirdGreatest=64
fi

thirdgreatestPercent=$(bc -l <<< $thirdLargest/$totallines)

if [ "$thirdgreatestPercent" -eq "0" ]; then
    echo "test"

else 
    echo "1/$thirdGreatest" | tr -d '\n' > $thirdOutput
    bc -l <<< $thirdLargest/$totallines | tr -d '\n' > $thirdPercent
fi


fourthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '4q;d')

if [ "$fourthLargest" = $one ]
then 
    fourthGreatest=1
elif [ "$fourthLargest" = $two ]
then
    fourthGreatest=2
elif [ "$fourthLargest" = $four ]
then
    fourthGreatest=4
elif [ "$fourthLargest" = $eight ]
then
    fourthGreatest=8
elif [ "$fourthLargest" = $sixteen ]
then
    fourthGreatest=16
elif [ "$fourthLargest" = $thirtytwo ]
then
    fourthGreatest=32
elif [ "$fourthLargest" = $sixtyfour ]
then
    fourthGreatest=64
fi


fourthgreatestPercent=$(bc -l <<< $fourthLargest/$totallines)

if [ "$fourthgreatestPercent" -eq "0" ]; then
    echo "test"

else 
    echo "1/$fourthGreatest" | tr -d '\n' > $fourthOutput
    bc -l <<< $fourthLargest/$totallines | tr -d '\n' > $fourthPercent
fi



fifthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '5q;d')

if [ "$fifthLargest" = $one ]
then 
    fifthGreatest=1
elif [ "$fifthLargest" = $two ]
then
    fifthGreatest=2
elif [ "$fifthLargest" = $four ]
then
    fifthGreatest=4
elif [ "$fifthLargest" = $eight ]
then
    fifthGreatest=8
elif [ "$fifthLargest" = $sixteen ]
then
    fifthGreatest=16
elif [ "$fifthLargest" = $thirtytwo ]
then
    fifthGreatest=32
elif [ "$fifthLargest" = $sixtyfour ]
then
    fifthGreatest=64
fi

fifthgreatestPercent=$(bc -l <<< $fifthLargest/$totallines)

if [ "$fifthgreatestPercent" -eq "0" ]; then
    echo "test"

else 
    echo "1/$fifthGreatest" | tr -d '\n' > $fifthOutput
    bc -l <<< $fifthLargest/$totallines | tr -d '\n' > $fifthPercent
fi


# -------------------------------------
# ======================================
# -------------------------------------



largestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '1q;d')

if [ "$largestTime" = $onetime ]
then 
    GreatestTime=1
elif [ "$largestTime" = $twotime ]
then
    GreatestTime=2
elif [ "$largestTime" = $fourtime ]
then
    GreatestTime=4
elif [ "$largestTime" = $eighttime ]
then
    GreatestTime=8
elif [ "$largestTime" = $sixteentime ]
then
    GreatestTime=16
elif [ "$largestTime" = $thirtytwotime ]
then
    GreatestTime=32
elif [ "$largestTime" = $sixtyfourtime ]
then
    GreatestTime=64
fi

firstPercentTime=$(bc -l <<< $largestTime/$totaltime)

if [ "$firstPercentTime" == "0" ]; then
    echo "test"
else 
    echo "1/$GreatestTime" | tr -d '\n' > $firstTimeOutput
    echo $firstPercentTime | tr -d '\n' > $firstTimePercent
fi


secondlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '2q;d')

if [ "$secondlargestTime" = $onetime ]
then 
    secondGreatestTime=1
elif [ "$secondlargestTime" = $twotime ]
then
    secondGreatestTime=2
elif [ "$secondlargestTime" = $fourtime ]
then
    secondGreatestTime=4
elif [ "$secondlargestTime" = $eighttime ]
then
    secondGreatestTime=8
elif [ "$secondlargestTime" = $sixteentime ]
then
    secondGreatestTime=16
elif [ "$secondlargestTime" = $thirtytwotime ]
then
    secondGreatestTime=32
elif [ "$secondlargestTime" = $sixtyfourtime ]
then
    secondGreatestTime=64
fi

secondPercentTime=$(bc -l <<< $secondlargestTime/$totaltime)

if [ "$secondPercentTime" -eq "0" ]; then
    echo "test"
else 
    echo "1/$secondGreatestTime" | tr -d '\n' > $secondTimeOutput
    echo $secondPercentTime | tr -d '\n' > $secondTimePercent
fi



thirdlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '3q;d')

if [ "$thirdlargestTime" = $onetime ]
then 
    thirdGreatestTime=1
elif [ "$thirdlargestTime" = $twotime ]
then
    thirdGreatestTime=2
elif [ "$thirdlargestTime" = $fourtime ]
then
    thirdGreatestTime=4
elif [ "$thirdlargestTime" = $eighttime ]
then
    thirdGreatestTime=8
elif [ "$thirdlargestTime" = $sixteentime ]
then
    thirdGreatestTime=16
elif [ "$thirdlargestTime" = $thirtytwotime ]
then
    thirdGreatestTime=32
elif [ "$thirdlargestTime" = $sixtyfourtime ]
then
    thirdGreatestTime=64
fi

thirdPercentTime=$(bc -l <<< $thirdlargestTime/$totaltime)

if [ "$thirdPercentTime" -eq "0" ]; then
    echo "test"

else 
    echo "1/$thirdGreatestTime" | tr -d '\n' > $thirdTimeOutput
    bc -l <<< $thirdlargestTime/$totaltime | tr -d '\n' > $thirdTimePercent
fi

fourtimethlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '4q;d')

if [ "$fourtimethlargestTime" = $onetime ]
then 
    fourtimethGreatestTime=1
elif [ "$fourtimethlargestTime" = $twotime ]
then
    fourtimethGreatestTime=2
elif [ "$fourtimethlargestTime" = $fourtime ]
then
    fourtimethGreatestTime=4
elif [ "$fourtimethlargestTime" = $eighttime ]
then
    fourtimethGreatestTime=8
elif [ "$fourtimethlargestTime" = $sixteentime ]
then
    fourtimethGreatestTime=16
elif [ "$fourtimethlargestTime" = $thirtytwotime ]
then
    fourtimethGreatestTime=32
elif [ "$fourtimethlargestTime" = $sixtyfourtime ]
then
    fourtimethGreatestTime=64
fi

fourthPercentTime=$(bc -l <<< $fourtimethlargestTime/$totaltime)

if [ "$fourthPercentTime" -eq "0" ]; then
    echo "test"

else 
    echo "1/$fourthGreatestTime" | tr -d '\n' > $fourthTimeOutput
    bc -l <<< $fourthlargestTime/$totaltime | tr -d '\n' > $fourthTimePercent
fi


fifthlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '5q;d')

if [ "$fifthlargestTime" = $onetime ]
then 
    fifthGreatestTime=1
elif [ "$fifthlargestTime" = $twotime ]
then
    fifthGreatestTime=2
elif [ "$fifthlargestTime" = $fourtime ]
then
    fifthGreatestTime=4
elif [ "$fifthlargestTime" = $eighttime ]
then
    fifthGreatestTime=8
elif [ "$fifthlargestTime" = $sixteentime ]
then
    fifthGreatestTime=16
elif [ "$fifthlargestTime" = $thirtytwotime ]
then
    fifthGreatestTime=32
elif [ "$fifthlargestTime" = $sixtyfourtime ]
then
    fifthGreatestTime=64
fi

fifthPercentTime=$(bc -l <<< $fifthlargestTime/$totaltime)

if [ "$fifthPercentTime" -eq "0" ]; then
    echo "test"

else 
    echo "1/$fifthGreatestTime" | tr -d '\n' > $fifthTimeOutput
    bc -l <<< $fifthlargestTime/$totaltime | tr -d '\n' > $fifthTimePercent
fi