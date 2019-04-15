#!/bin/bash
file=$1

ascendingSingle=$(deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" |  cut -d '~' -f1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p+1){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)
descendingSingle=$(deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" |  cut -d '~' -f1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-1){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)
ascendingDouble=$(deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" |  cut -d '~' -f1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p+2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' |  tr "\t" "~" | cut -d '~' -f3)
descendingDouble=$(deg $file | grep -v '!' | grep -v '=' | grep -v '*' | tr  "\t" "~" |  cut -d '~' -f1 | tr '.' 'r' | sed 's/^.//' | grep '.' | grep -v '-' | grep -v '+' | awk '{l=p=$1}{while((r=getline)>=0){if($1==p-2){p=$1;continue};print(l==p?l:l","p);l=p=$1;if(r==0){ break };}}' |  grep ',' | tr ',' '\t' | awk 'BEGIN { OFS = "\t" } { $3 = $2 - $1 } 1' | tr "\t" "~" | cut -d '~' -f3)

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

echo $ascSingleTwo
echo $ascSingleThree
echo $ascSingleFour
echo $ascSingleFive
echo $ascSingleSix
echo $ascSingleAbove
echo $ascSingleLargest

echo $ascDoubleTwo
echo $ascDoubleThree
echo $ascDoubleFour
echo $ascDoubleFive
echo $ascDoubleSix
echo $ascDoubleAbove
echo $ascDoubleLargest

echo $descSingleTwo
echo $descSingleThree
echo $descSingleFour
echo $descSingleFive
echo $descSingleSix
echo $descSingleAbove
echo $descSingleLargest

echo $descDoubleTwo
echo $descDoubleThree
echo $descDoubleFour
echo $descDoubleFive
echo $descDoubleSix
echo $descDoubleAbove
echo $descDoubleLargest

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