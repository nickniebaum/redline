<?php
    // Default usage:
    // $this->load->view('template/asides/lipsum',array(
    //     'word_count'=>75,
    //     'format_ratio'=>.5,
    //     'links'=>FALSE,
    //     'bold'=>FALSE,
    //     'italic'=>FALSE,
    //     'underline'=>FALSE,
    // ));

    // Set default view variables
    $word_count=isset($word_count) ? $word_count : 75;
    $format_ratio=isset($format_ratio) && $format_ratio<=1 && $format_ratio>0 ? $format_ratio : .5;
    $links=isset($links) ? $links : FALSE;
    $bold=isset($bold) ? $bold : FALSE;
    $italic=isset($italic) ? $italic : FALSE;
    $underline=isset($underline) ? $underline : FALSE;

    // Calculates how many words per formatting type for each type if not specified
    $default_format_types_count=0;
    $default_format_types_count+=$links ? 1 : 0;
    $default_format_types_count+=$bold ? 1 : 0;
    $default_format_types_count+=$italic ? 1 : 0;
    $default_format_types_count+=$underline ? 1 : 0;
    $default_format_word_count=$default_format_types_count==0 ? 0 : floor($word_count*$format_ratio/$default_format_types_count);

    // Create empty arrays to store word indexes for each formatting type
    $formatted_words=array();

    // Get an array of words
    $words=explode(' ',lipsum($word_count));

    // Check for link formatting
    if($links)
    {
        // Determine number of words to format as links
        $links=is_numeric($links) ? $links : $default_format_word_count;
        
        // Format words as links
        for($i=0;$i<$links;$i++)
        {
            // Find a word index that isn't formatted
            do
            {
                $format_index=rand(0,$word_count-1);
            }
            while(in_array($format_index,$formatted_words));
            
            // Add to the exclusion array
            $formatted_words[]=$format_index;

            // Format word as link
            $words[$format_index]=anchor('#',$words[$format_index]);
        }
    }

    // Check for bold formatting
    if($bold)
    {
        // Determine number of words to format as bold
        $bold=is_numeric($bold) ? $bold : $default_format_word_count;

        // Format words as bold
        for($i=0;$i<$bold;$i++)
        {
            // Find a word index that isn't formatted
            do
            {
                $format_index=rand(0,$word_count-1);
            }
            while(in_array($format_index,$formatted_words));
            
            // Add to the exclusion array
            $formatted_words[]=$format_index;

            // Format word as bold
            $words[$format_index]='<strong>'.$words[$format_index].'</strong>';
        }
    }

    // Check for italic formatting
    if($italic)
    {
        // Determine number of words to format as italic
        $italic=is_numeric($italic) ? $italic : $default_format_word_count;
        
        // Format words as italic
        for($i=0;$i<$italic;$i++)
        {
            // Find a word index that isn't formatted
            do
            {
                $format_index=rand(0,$word_count-1);
            }
            while(in_array($format_index,$formatted_words));
            
            // Add to the exclusion array
            $formatted_words[]=$format_index;

            // Format word as italic
            $words[$format_index]='<em>'.$words[$format_index].'</em>';
        }
    }

    // Check for underline formatting
    if($underline)
    {
        // Determine number of words to format as underline
        $underline=is_numeric($underline) ? $underline : $default_format_word_count;
        
        // Format words as underline
        for($i=0;$i<$underline;$i++)
        {
            // Find a word index that isn't formatted
            do
            {
                $format_index=rand(0,$word_count-1);
            }
            while(in_array($format_index,$formatted_words));
            
            // Add to the exclusion array
            $formatted_words[]=$format_index;

            // Format word as underline
            $words[$format_index]='<u>'.$words[$format_index].'</u>';
        }
    }

    // Get formatted lorem ipsum text
    $lipsum=implode(' ',$words);

    // Output the paragraph
    echo '<p>'.$lipsum.'</p>';