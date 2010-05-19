#! /bin/sh
#
# Image Upload Handler
# --------------------
#
# The idea is that we have built Pure-FTPd with the --with-uploadscript
# option, and are running the server with the -o option. This means that
# We can run pure-uploadscript in the background to call this script
# every time a new file is uploaded...
#
# This script will take that file, create a resized version using
# ImageMagick, then copy the resized and original files to the target dir.
# (Exisitng files with same name in target directory will be overwritten.)
# 
# It is intended that the FTP server is configured so that each user uploads
# into their own directory under srcdir, so they can't overwrite other people's files! 

srcdir="/var/www/mizu-svn/uploadedimages" #no trailing slashes please!
target="/var/www/mizu-svn/incoming"

filename=$(basename "$1")
filedir=$(dirname "$1")
fnamelen=${#filename}
#echo 'in script>'  $1 '<'
# pure-uploadscript will give us the full path of the uploaded file. We only
# want to process files that are uploaded to $srcdir (and its sub-dirs)...
if [ ${filedir:0:${#srcdir}} == "$srcdir" ]
then
	subdir=${filedir:${#srcdir}:${#filedir}}
else
	exit 1
fi

# we will strip the extension from the file name (if present) so that
# we can later reconstruct the file name with a normalised extension
orig_filename="$filename"
orig_extension=""
if [ $fnamelen -ge 5 ]
then
	stub=${filename: -5}  # get last 5 chars of filename
	
	if [ ${stub:1:1} == "." ]
	# eg 'x.jpg'
	then
		orig_extension=${filename: -3}
		fnamelen=$fnamelen-4
	else	
		if [ ${stub:0:1} == "." ]
		# eg '.jpeg'
		then
			orig_extension=${filename: -4}
			fnamelen=$fnamelen-5
		fi
	fi
	filename=${filename:0:$fnamelen}
fi

img_type=`identify "$1" 2> /dev/null`
if [ "$img_type" != "" ]
# if ImageMagick recognises the file type...
then
        echo 'NEWDIR: '$target$subdir

	dir_original="$target$subdir/original"
	dir_resized="$target$subdir/630x630"
	dir_thumbnail_s="$target$subdir/32x32"
	dir_thumbnail_m="$target$subdir/80x80"
	dir_thumbnail_l="$target$subdir/160x160"
	
	mkdir -p "$dir_original" 2> /dev/null
	mkdir -p "$dir_resized" 2> /dev/null
	mkdir -p "$dir_thumbnail_s" 2> /dev/null
	mkdir -p "$dir_thumbnail_m" 2> /dev/null
	mkdir -p "$dir_thumbnail_l" 2> /dev/null
	
	pattern="$1 (JPEG)" # we could potentially add other acceptable output types here, eg (JPEG|PNG)
	out_type=`echo "$img_type" | grep -Eso "$pattern"`
	if [ ${out_type: -4}  == "JPEG" ]
	# if src image was a JPEG...
	then
		cp --force "$1" "$dir_original/$filename.jpg" 2> /dev/null
	else
		filename="$filename.$orig_extension"
		#convert "$1" -quality 70 -auto-orient "$dir_original/$filename.jpg"
                convert "$1" -quality 70  "$dir_original/$filename.jpg"
	
fi
	#convert "$1" -resize 630x630 -quality 70 -auto-orient "$dir_resized/$filename.jpg"
	#convert "$1" -resize 32x32 -quality 70 -auto-orient "$dir_thumbnail_s/$filename.jpg"
	#convert "$1" -resize 80x80 -quality 70 -auto-orient "$dir_thumbnail_m/$filename.jpg"
	#convert "$1" -resize 160x160 -quality 70 -auto-orient "$dir_thumbnail_l/$filename.jpg"

        convert "$1" -resize 630x630 -quality 70  "$dir_resized/$filename.jpg"
        convert "$1" -resize 32x32 -quality 70  "$dir_thumbnail_s/$filename.jpg"
        convert "$1" -resize 80x80 -quality 70  "$dir_thumbnail_m/$filename.jpg"
        convert "$1" -resize 160x160 -quality 70  "$dir_thumbnail_l/$filename.jpg"


	
	chmod -R 0777 "$target"
	
	# note: we are not deleting the original uploaded file...
	# there needs to be a 'garbage collection' script that deletes old files from srcdir
	
	exit 0
else
	exit 2
fi
