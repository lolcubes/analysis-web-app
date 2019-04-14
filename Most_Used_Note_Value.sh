#!/bin/bash

file=$1
fileprep="$(grep -v '=' $file | grep -v '*' | grep -v '!' |  grep -o '[[:digit:]]*' | grep '.')"

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
echo "<h4>Most Used Note Value:</h4>"

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

echo Most Used: $greatest
percent1=$(bc -l <<< $largest/$totallines)
echo Percent: $percent1

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

echo Second Most Used: $secondGreatest
percent2=$(bc -l <<< $secondLargest/$totallines)
echo Percent: $percent2


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

echo Third Most Used: $thirdGreatest
percent3=$(bc -l <<< $thirdLargest/$totallines)
echo Percent: $percent3

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

echo Fourth Most Used: $fourthGreatest
percent4=$(bc -l <<< $fourthLargest/$totallines)
echo Percent: $percent4

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

echo Fifth Most Used: $fifthGreatest
percent5=$(bc -l <<< $fifthLargest/$totallines)
echo Percent: $percent5

sixthLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '6q;d')

if [ "$sixthLargest" = $one ]
then 
    sixthGreatest=1
elif [ "$sixthLargest" = $two ]
then
    sixthGreatest=2
elif [ "$sixthLargest" = $four ]
then
    sixthGreatest=4
elif [ "$sixthLargest" = $eight ]
then
    sixthGreatest=8
elif [ "$sixthLargest" = $sixteen ]
then
    sixthGreatest=16
elif [ "$sixthLargest" = $thirtytwo ]
then
    sixthGreatest=32
elif [ "$sixthLargest" = $sixtyfour ]
then
    sixthGreatest=64
fi

echo Sixth Most Used: $sixthGreatest
percent6=$(bc -l <<< $sixthLargest/$totallines)
echo Percent: $percent6

seventhLargest=$(printf '%s\n' "${array[@]}" | sort -rn | sed '7q;d')

if [ "$seventhLargest" = $one ]
then 
    seventhGreatest=1
elif [ "$seventhLargest" = $two ]
then
    seventhGreatest=2
elif [ "$seventhLargest" = $four ]
then
    seventhGreatest=4
elif [ "$seventhLargest" = $eight ]
then
    seventhGreatest=8
elif [ "$seventhLargest" = $sixteen ]
then
    seventhGreatest=16
elif [ "$seventhLargest" = $thirtytwo ]
then
    seventhGreatest=32
elif [ "$seventhLargest" = $sixtyfour ]
then
    seventhGreatest=64
fi

echo Seventh Most Used: $seventhGreatest
percent7=$(bc -l <<< $seventhLargest/$totallines)
echo Percent: $percent7


# -------------------------------------

# largestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '1q;d')

# if [ "$largestTime" = $onetime ]
# then 
#     GreatestTime=1
# elif [ "$largestTime" = $twotime ]
# then
#     GreatestTime=2
# elif [ "$largestTime" = $fourtime ]
# then
#     GreatestTime=4
# elif [ "$largestTime" = $eighttime ]
# then
#     GreatestTime=8
# elif [ "$largestTime" = $sixteentime ]
# then
#     GreatestTime=16
# elif [ "$largestTime" = $thirtytwotime ]
# then
#     GreatestTime=32
# elif [ "$largestTime" = $sixtyfourtime ]
# then
#     GreatestTime=64
# fi

# echo $GreatestTime
# bc -l <<< $largestTime/$totaltime

# secondlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '2q;d')

# if [ "$secondlargestTime" = $onetime ]
# then 
#     secondGreatestTime=1
# elif [ "$secondlargestTime" = $twotime ]
# then
#     secondGreatestTime=2
# elif [ "$secondlargestTime" = $fourtime ]
# then
#     secondGreatestTime=4
# elif [ "$secondlargestTime" = $eighttime ]
# then
#     secondGreatestTime=8
# elif [ "$secondlargestTime" = $sixteentime ]
# then
#     secondGreatestTime=16
# elif [ "$secondlargestTime" = $thirtytwotime ]
# then
#     secondGreatestTime=32
# elif [ "$secondlargestTime" = $sixtyfourtime ]
# then
#     secondGreatestTime=64
# fi

# echo $secondGreatestTime
# bc -l <<< $secondlargestTime/$totaltime


# thirdlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '3q;d')

# if [ "$thirdlargestTime" = $onetime ]
# then 
#     thirdGreatestTime=1
# elif [ "$thirdlargestTime" = $twotime ]
# then
#     thirdGreatestTime=2
# elif [ "$thirdlargestTime" = $fourtime ]
# then
#     thirdGreatestTime=4
# elif [ "$thirdlargestTime" = $eighttime ]
# then
#     thirdGreatestTime=8
# elif [ "$thirdlargestTime" = $sixteentime ]
# then
#     thirdGreatestTime=16
# elif [ "$thirdlargestTime" = $thirtytwotime ]
# then
#     thirdGreatestTime=32
# elif [ "$thirdlargestTime" = $sixtyfourtime ]
# then
#     thirdGreatestTime=64
# fi

# echo $thirdGreatestTime
# bc -l <<< $thirdlargestTime/$totaltime

# fourtimethlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '4q;d')

# if [ "$fourtimethlargestTime" = $onetime ]
# then 
#     fourtimethGreatestTime=1
# elif [ "$fourtimethlargestTime" = $twotime ]
# then
#     fourtimethGreatestTime=2
# elif [ "$fourtimethlargestTime" = $fourtime ]
# then
#     fourtimethGreatestTime=4
# elif [ "$fourtimethlargestTime" = $eighttime ]
# then
#     fourtimethGreatestTime=8
# elif [ "$fourtimethlargestTime" = $sixteentime ]
# then
#     fourtimethGreatestTime=16
# elif [ "$fourtimethlargestTime" = $thirtytwotime ]
# then
#     fourtimethGreatestTime=32
# elif [ "$fourtimethlargestTime" = $sixtyfourtime ]
# then
#     fourtimethGreatestTime=64
# fi

# echo $fourtimethGreatestTime
# bc -l <<< $fourtimethlargestTime/$totaltime

# fifthlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '5q;d')

# if [ "$fifthlargestTime" = $onetime ]
# then 
#     fifthGreatestTime=1
# elif [ "$fifthlargestTime" = $twotime ]
# then
#     fifthGreatestTime=2
# elif [ "$fifthlargestTime" = $fourtime ]
# then
#     fifthGreatestTime=4
# elif [ "$fifthlargestTime" = $eighttime ]
# then
#     fifthGreatestTime=8
# elif [ "$fifthlargestTime" = $sixteentime ]
# then
#     fifthGreatestTime=16
# elif [ "$fifthlargestTime" = $thirtytwotime ]
# then
#     fifthGreatestTime=32
# elif [ "$fifthlargestTime" = $sixtyfourtime ]
# then
#     fifthGreatestTime=64
# fi

# echo $fifthGreatestTime
# bc -l <<< $fifthlargestTime/$totaltime

# sixthlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '6q;d')

# if [ "$sixthlargestTime" = $onetime ]
# then 
#     sixthGreatestTime=1
# elif [ "$sixthlargestTime" = $twotime ]
# then
#     sixthGreatestTime=2
# elif [ "$sixthlargestTime" = $fourtime ]
# then
#     sixthGreatestTime=4
# elif [ "$sixthlargestTime" = $eighttime ]
# then
#     sixthGreatestTime=8
# elif [ "$sixthlargestTime" = $sixteentime ]
# then
#     sixthGreatestTime=16
# elif [ "$sixthlargestTime" = $thirtytwotime ]
# then
#     sixthGreatestTime=32
# elif [ "$sixthlargestTime" = $sixtyfourtime ]
# then
#     sixthGreatestTime=64
# fi

# echo $sixthGreatestTime
# bc -l <<< $sixthlargestTime/$totaltime

# seventhlargestTime=$(printf '%s\n' "${timearray[@]}" | sort -rn | sed '7q;d')

# if [ "$seventhlargestTime" = $onetime ]
# then 
#     seventhGreatestTime=1
# elif [ "$seventhlargestTime" = $twotime ]
# then
#     seventhGreatestTime=2
# elif [ "$seventhlargestTime" = $fourtime ]
# then
#     seventhGreatestTime=4
# elif [ "$seventhlargestTime" = $eighttime ]
# then
#     seventhGreatestTime=8
# elif [ "$seventhlargestTime" = $sixteentime ]
# then
#     seventhGreatestTime=16
# elif [ "$seventhlargestTime" = $thirtytwotime ]
# then
#     seventhGreatestTime=32
# elif [ "$seventhlargestTime" = $sixtyfourtime ]
# then
#     seventhGreatestTime=64
# fi

# echo $seventhGreatestTime
# bc -l <<< $seventhlargestTime/$totaltime
