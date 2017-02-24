<?php
	#
	# This is a test program for the portable PHP password hashing framework.
	#
	# Written by Solar Designer and placed in the public domain.
	# See PasswordHash.php for more information.
	#

	require 'PasswordHash.php';

	header('Content-type: text/plain');

	# Try to use stronger but system-specific hashes, with a possible fallback to
	# the weaker portable hashes.
	$t_hasher = new PasswordHash(16, FALSE);
	
	$pwd1 = "P";
	$pre_hash_time = time();
	$hash = $t_hasher->HashPassword($pwd1);
	$post_hash_time = time();
	print "*** " . $pwd1 . " *** \nbecomes \n*** " . $hash . " ***.\n";
	print "Hashed password length is: " . strlen($hash) . ".\n\n";
	$pwd2 = "Philipdsfbsfbsf1";
	$pre_check_time = time();
	$pwd2_check = $t_hasher->CheckPassword($pwd2, $hash);
	$post_check_time = time();
	if ($pwd2_check) {
		print "The two passwords are the SAME: \n" . $pwd1 . "\n" . $pwd2 . ".\n\n";
	} else {
		print "The two passwords are DIFFERENT: \n" . $pwd1 . "\n" . $pwd2 . ".\n\n";
	}
	$hash_time_needed = $post_hash_time - $pre_hash_time;
	print "Time to create the hashed password is: " . $hash_time_needed . " seconds.\n";
	$check_time_needed = $post_check_time - $pre_check_time;
	print "Time to check the hashed password is: " . $check_time_needed . " seconds.\n";