#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/scales/"
deg="${removed}deg.txt"
ascSingleDir="${output}ascending-single/"
ascDoubleDir="${output}ascending-double/"
descSingleDir="${output}descending-single/"
descDoubleDir="${output}descending-double/"

mkdir $ascSingleDir
mkdir $ascDoubleDir
mkdir $descSingleDir
mkdir $descDoubleDir

ascendingSingle=$(/var/www/html/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | sed 's/[^0-9]*//g')
descendingSingle=$(/var/www/html/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | sed 's/[^0-9]*//g' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-1){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)
ascendingDouble=$(/var/www/html/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | sed 's/[^0-9]*//g' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p+2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' |  tr "\t" "~" | cut -d '~' -f3)
descendingDouble=$(/var/www/html/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | sed 's/[^0-9]*//g' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)

echo "$ascendingSingle" > "${output}test.txt"

ascSingle=$(echo "$ascendingSingle" | while read i; do echo "$i+1" | bc; done )
descSingle=$(echo "$descendingSingle" | while read i; do echo "$i-1" | bc; done | sed 's/^.//')
descDouble=$(echo "$descendingDouble" | while read i; do echo "$i/2" | bc; done | while read i; do echo "$i-1" | bc; done | sed 's/^.//')
ascDouble=$(echo "$ascendingDouble" | while read i; do echo "$i/2" | bc; done | while read i; do echo "$i+1" | bc; done )

ascSingleTwo=$( echo "$ascSingle" | grep '\b2\b' | wc -l)
ascSingleThree=$( echo "$ascSingle" | grep '\b3\b' | wc -l)
ascSingleFour=$( echo "$ascSingle" | grep '\b4\b' | wc -l)
ascSingleFive=$( echo "$ascSingle" | grep '\b5\b' | wc -l)
ascSingleSix=$( echo "$ascSingle" | grep '\b6\b' | wc -l)
ascSingleAbove=$( echo "$ascSingle" | grep -v '\b6\b' | grep -v '\b5\b' | grep -v '\b4\b' | grep -v '\b3\b' | grep -v '\b2\b' | wc -l)
ascSingleLargest=$( echo "$ascSingle" | sort -n |  tail -n1 )

ascDoubleTwo=$( echo "$ascDouble" | grep '\b2\b' | wc -l)
ascDoubleThree=$( echo "$ascDouble" | grep '\b3\b' | wc -l)
ascDoubleFour=$( echo "$ascDouble" | grep '\b4\b' | wc -l)
ascDoubleFive=$( echo "$ascDouble" | grep '\b5\b' | wc -l)
ascDoubleSix=$( echo "$ascDouble" | grep '\b6\b' | wc -l)
ascDoubleAbove=$( echo "$ascDouble" | grep -v '\b6\b' | grep -v '\b5\b' | grep -v '\b4\b' | grep -v '\b3\b' | grep -v '\b2\b' | wc -l)
ascDoubleLargest=$( echo "$ascDouble" | sort -n |  tail -n1 )

descSingleTwo=$( echo "$descSingle" | grep '\b2\b' | wc -l)
descSingleThree=$( echo "$descSingle" | grep '\b3\b' | wc -l)
descSingleFour=$( echo "$descSingle" | grep '\b4\b' | wc -l)
descSingleFive=$( echo "$descSingle" | grep '\b5\b' | wc -l)
descSingleSix=$( echo "$descSingle" | grep '\b6\b' | wc -l)
descSingleAbove=$( echo "$descSingle" | grep -v '\b6\b' | grep -v '\b5\b' | grep -v '\b4\b' | grep -v '\b3\b' | grep -v '\b2\b' | wc -l)
descSingleLargest=$( echo "$descSingle" | sort -n |  tail -n1 )

descDoubleTwo=$( echo "$descDouble" | grep '\b2\b' | wc -l)
descDoubleThree=$( echo "$descDouble" | grep '\b3\b' | wc -l)
descDoubleFour=$( echo "$descDouble" | grep '\b4\b' | wc -l)
descDoubleFive=$( echo "$descDouble" | grep '\b5\b' | wc -l)
descDoubleSix=$( echo "$descDouble" | grep '\b6\b' | wc -l)
descDoubleAbove=$( echo "$descDouble" | grep -v '\b6\b' | grep -v '\b5\b' | grep -v '\b4\b' | grep -v '\b3\b' | grep -v '\b2\b' | wc -l)
descDoubleLargest=$( echo "$descDouble" | sort -n |  tail -n1 )

ascSingleTwoOutput="${ascSingleDir}2.txt"
ascSingleThreeOutput="${ascSingleDir}3.txt"
ascSingleFourOutput="${ascSingleDir}4.txt"
ascSingleFiveOutput="${ascSingleDir}5.txt"
ascSingleSixOutput="${ascSingleDir}6.txt"
ascSingleAboveOutput="${ascSingleDir}seven-above.txt"
ascSingleLargestOutput="${ascSingleDir}largest.txt"

ascDoubleTwoOutput="${ascDoubleDir}2.txt"
ascDoubleThreeOutput="${ascDoubleDir}3.txt"
ascDoubleFourOutput="${ascDoubleDir}4.txt"
ascDoubleFiveOutput="${ascDoubleDir}5.txt"
ascDoubleSixOutput="${ascDoubleDir}6.txt"
ascDoubleAboveOutput="${ascDoubleDir}seven-above.txt"
ascDoubleLargestOutput="${ascDoubleDir}largest.txt"

descSingleTwoOutput="${descSingleDir}2.txt"
descSingleThreeOutput="${descSingleDir}3.txt"
descSingleFourOutput="${descSingleDir}4.txt"
descSingleFiveOutput="${descSingleDir}5.txt"
descSingleSixOutput="${descSingleDir}6.txt"
descSingleAboveOutput="${descSingleDir}seven-above.txt"
descSingleLargestOutput="${descSingleDir}largest.txt"

descDoubleTwoOutput="${descDoubleDir}2.txt"
descDoubleThreeOutput="${descDoubleDir}3.txt"
descDoubleFourOutput="${descDoubleDir}4.txt"
descDoubleFiveOutput="${descDoubleDir}5.txt"
descDoubleSixOutput="${descDoubleDir}6.txt"
descDoubleAboveOutput="${descDoubleDir}seven-above.txt"
descDoubleLargestOutput="${descDoubleDir}largest.txt"

echo $ascSingleTwo | tr -d '\n' > $ascSingleTwoOutput
echo $ascSingleThree | tr -d '\n' > $ascSingleThreeOutput
echo $ascSingleFour | tr -d '\n' > $ascSingleFourOutput
echo $ascSingleFive | tr -d '\n' > $ascSingleFiveOutput
echo $ascSingleSix | tr -d '\n' > $ascSingleSixOutput
echo $ascSingleAbove | tr -d '\n' > $ascSingleAboveOutput
echo $ascSingleLargest | tr -d '\n' > $ascSingleLargestOutput

echo $ascDoubleTwo | tr -d '\n' > $ascDoubleTwoOutput
echo $ascDoubleThree | tr -d '\n' > $ascDoubleThreeOutput
echo $ascDoubleFour | tr -d '\n' > $ascDoubleFourOutput
echo $ascDoubleFive | tr -d '\n' > $ascDoubleFiveOutput
echo $ascDoubleSix | tr -d '\n' > $ascDoubleSixOutput
echo $ascDoubleAbove | tr -d '\n' > $ascDoubleAboveOutput
echo $ascDoubleLargest | tr -d '\n' > $ascDoubleLargestOutput

echo $descSingleTwo | tr -d '\n' > $descSingleTwoOutput
echo $descSingleThree | tr -d '\n' > $descSingleThreeOutput
echo $descSingleFour | tr -d '\n' > $descSingleFourOutput
echo $descSingleFive | tr -d '\n' > $descSingleFiveOutput
echo $descSingleSix | tr -d '\n' > $descSingleSixOutput
echo $descSingleAbove | tr -d '\n' > $descSingleAboveOutput
echo $descSingleLargest | tr -d '\n' > $descSingleLargestOutput

echo $descDoubleTwo | tr -d '\n' > $descDoubleTwoOutput
echo $descDoubleThree | tr -d '\n' > $descDoubleThreeOutput
echo $descDoubleFour | tr -d '\n' > $descDoubleFourOutput
echo $descDoubleFive | tr -d '\n' > $descDoubleFiveOutput
echo $descDoubleSix | tr -d '\n' > $descDoubleSixOutput
echo $descDoubleAbove | tr -d '\n' > $descDoubleAboveOutput
echo $descDoubleLargest | tr -d '\n' > $descDoubleLargestOutput
