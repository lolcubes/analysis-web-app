#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/scales/"

ascSingleDir="${output}ascending-single/"
ascDoubleDir="${output}ascending-double/"
descSingleDir="${output}descending-single/"
descDoubleDir="${output}descending-double/"

mkdir $ascSingleDir
mkdir $ascDoubleDir
mkdir $descSingleDir
mkdir $descDoubleDir

ascendingSingle=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p+1){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)
descendingSingle=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-1){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)
ascendingDouble=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p+2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' |  tr "\t" "~" | cut -d '~' -f3)
descendingDouble=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" | rs -c~ -T | rs 0 1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)

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

echo $ascSingleTwo > $ascSingleTwoOutput
echo $ascSingleThree > $ascSingleThreeOutput
echo $ascSingleFour > $ascSingleFourOutput
echo $ascSingleFive > $ascSingleFiveOutput
echo $ascSingleSix > $ascSingleSixOutput
echo $ascSingleAbove > $ascSingleAboveOutput
echo $ascSingleLargest > $ascSingleLargestOutput

echo $ascDoubleTwo > $ascDoubleTwoOutput
echo $ascDoubleThree > $ascDoubleThreeOutput
echo $ascDoubleFour > $ascDoubleFourOutput
echo $ascDoubleFive > $ascDoubleFiveOutput
echo $ascDoubleSix > $ascDoubleSixOutput
echo $ascDoubleAbove > $ascDoubleAboveOutput
echo $ascDoubleLargest > $ascDoubleLargestOutput

echo $descSingleTwo > $descSingleTwoOutput
echo $descSingleThree > $descSingleThreeOutput
echo $descSingleFour > $descSingleFourOutput
echo $descSingleFive > $descSingleFiveOutput
echo $descSingleSix > $descSingleSixOutput
echo $descSingleAbove > $descSingleAboveOutput
echo $descSingleLargest > $descSingleLargestOutput

echo $descDoubleTwo > $descDoubleTwoOutput
echo $descDoubleThree > $descDoubleThreeOutput
echo $descDoubleFour > $descDoubleFourOutput
echo $descDoubleFive > $descDoubleFiveOutput
echo $descDoubleSix > $descDoubleSixOutput
echo $descDoubleAbove > $descDoubleAboveOutput
echo $descDoubleLargest > $descDoubleLargestOutput

# ascending:
# Whole Step:
#         2: (amount of)
#         3:
#         4:
#         5:
#         6:
#         7:
#     Half Step:
#         2:
#         3:
#         4:
#         5:
#         6:
#         7:
#     Double Step:
#         2:
#         3:
#         4:
#         5:
#         6:
#         7:
# Descending
#     Whole Step:
#         2: (amount of)
#         3:
#         4:
#         5:
#         6:
#         7:
#     Half Step:
#         2:
#         3:
#         4:
#         5:
#         6:
#         7:
#     Double Step:
#         2:
#         3:
#         4:
#         5:
#         6:
#         7:   