Installing
==========

Add module

    git submodule add git://github.com/atma/ko3-twig-views.git modules/twig

Fetch Twig files

    git submodule update --recursive --init

Activate module in your bootstrap.php

    Kohana::modules(array(
	    ...
        'twig'          => MODPATH.'twig', // Twig templating for Kohana
	));
