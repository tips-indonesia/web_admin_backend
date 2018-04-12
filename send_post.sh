numofarg=$(($#-1))
FOO="{"
URL=""
iter=0
keyorval=0
for i; do 
	# echo $i
	if [ $iter -eq 0 ]
	then
		URL="$i"
	else
		if [ $keyorval -eq 0 ]
		then
			FOO="$FOO\"$i\":"
			keyorval=1
		else
			FOO="$FOO\"$i\""
			keyorval=0
			if [ $iter -ne $numofarg ]
			then
				FOO="$FOO,"
			fi
		fi
	fi
	iter=$(($iter+1))
done
FOO="$FOO}"
# echo $URL
comd="curl -v -H \"Accept: application/json\" -H \"Content-type: application/json\" -X POST -d '$FOO' $URL --trace-ascii /dev/stdout"
eval $comd