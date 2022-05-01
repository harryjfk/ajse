<?php
/**
 * Data sanitization functions
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// URL (esc_url)
function melissa_sanitize_url($input) {
  return esc_url($input);
}

// Text field (esc_html)
function melissa_sanitize_text_esc_html($input) {
  return esc_html($input);
}

// Number field (intval)
function melissa_sanitize_number_intval($input) {
  if (is_numeric($input) && $input >= 1) {
    return intval($input);
  } else {
    return '';
  }
}

// Transparency value (number field; intval)
function melissa_sanitize_transparency_intval($input) {
  if (is_numeric($input) && $input >= 1 && $input <= 9) {
    return intval($input);
  } else {
    return 9;
  }
}

// Video volume value (number field; intval)
function melissa_sanitize_video_volume_intval($input) {
  if (is_numeric($input) && $input >= 0 && $input <= 100) {
    return intval($input);
  } else {
    return 0;
  }
}

// Checkbox
function melissa_sanitize_checkbox($input) {
  if ($input == 1) {
    return 1;
  } else {
    return 0;
  }
}

// Header type
function melissa_sanitize_header_type($input) {
  $valid = array(
    'simple-header' => 'Simple header (without animation)',
    'rev-slider-header' => 'Header with animation',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'simple-header';
  }
}

// Header background type
function melissa_sanitize_header_bg_type($input) {
  $valid = array(
    'image' => 'Image',
    'video' => 'Video',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'image';
  }
}

// Logo type
function melissa_sanitize_logo_type($input) {
  $valid = array(
    'text' => 'Text',
    'image' => 'Image',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'text';
  }
}

// Blog layout
function melissa_sanitize_blog_layout($input) {
  $valid = array(
    '3c' => '3 Columns',
    '2c-ls' => '2 Columns + Left sidebar',
    '2c-rs' => '2 Columns + Right sidebar',
    '2c' => '2 Columns',
    '1c-ls' => '1 Column + Left sidebar',
    '1c-rs' => '1 Column + Right sidebar',
    '1c' => '1 Column',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return '3c';
  }
}

// Pagination type
function melissa_sanitize_pagination_type($input) {
  $valid = array(
    'standard_pagination' => 'Standard pagination',
    'next_prev_links' => 'Next/Previous page links',
    'infinite_scroll' => 'Infinite scroll',
    'load_more' => 'Load More button'
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'standard_pagination';
  }
}

// Target attribute
function melissa_sanitize_target($input) {
  $valid = array(
    '_blank' => 'New tab (_blank)',
    '_self' => 'Current tab (_self)'
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return '_self';
  }
}

// Excerpt / Read more tag
function melissa_sanitize_blog_excerpt_type($input) {
  $valid = array(
    'excerpt' => 'Excerpt',
    'more-tag' => 'Read More tag',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'excerpt';
  }
}

// Fonts
function melissa_sanitize_fonts($input) {
  $font_families = array('Arial' => 'Arial', 'Verdana' => 'Verdana', 'Trebuchet MS' => 'Trebuchet MS', 'Tahoma' => 'Tahoma', 'Palatino' => 'Palatino', 'Helvetica' => 'Helvetica', 'ABeeZee' => 'ABeeZee', 'Abel' => 'Abel', 'Abril Fatface' => 'Abril Fatface', 'Aclonica' => 'Aclonica', 'Acme' => 'Acme', 'Actor' => 'Actor', 'Adamina' => 'Adamina', 'Advent Pro' => 'Advent Pro', 'Aguafina Script' => 'Aguafina Script', 'Akronim' => 'Akronim', 'Aladin' => 'Aladin', 'Aldrich' => 'Aldrich', 'Alegreya' => 'Alegreya', 'Alegreya SC' => 'Alegreya SC', 'Alegreya Sans' => 'Alegreya Sans', 'Alegreya Sans SC' => 'Alegreya Sans SC', 'Alex Brush' => 'Alex Brush', 'Alfa Slab One' => 'Alfa Slab One', 'Alice' => 'Alice', 'Alike' => 'Alike', 'Alike Angular' => 'Alike Angular', 'Allan' => 'Allan', 'Allerta' => 'Allerta', 'Allerta Stencil' => 'Allerta Stencil', 'Allura' => 'Allura', 'Almendra' => 'Almendra', 'Almendra Display' => 'Almendra Display', 'Almendra SC' => 'Almendra SC', 'Amarante' => 'Amarante', 'Amaranth' => 'Amaranth', 'Amatic SC' => 'Amatic SC', 'Amethysta' => 'Amethysta', 'Anaheim' => 'Anaheim', 'Andada' => 'Andada', 'Andika' => 'Andika', 'Angkor' => 'Angkor', 'Annie Use Your Telescope' => 'Annie Use Your Telescope', 'Anonymous Pro' => 'Anonymous Pro', 'Antic' => 'Antic', 'Antic Didone' => 'Antic Didone', 'Antic Slab' => 'Antic Slab', 'Anton' => 'Anton', 'Arapey' => 'Arapey', 'Arbutus' => 'Arbutus', 'Arbutus Slab' => 'Arbutus Slab', 'Architects Daughter' => 'Architects Daughter', 'Archivo Black' => 'Archivo Black', 'Archivo Narrow' => 'Archivo Narrow', 'Arimo' => 'Arimo', 'Arizonia' => 'Arizonia', 'Armata' => 'Armata', 'Artifika' => 'Artifika', 'Arvo' => 'Arvo', 'Asap' => 'Asap', 'Asset' => 'Asset', 'Astloch' => 'Astloch', 'Asul' => 'Asul', 'Atomic Age' => 'Atomic Age', 'Aubrey' => 'Aubrey', 'Audiowide' => 'Audiowide', 'Autour One' => 'Autour One', 'Average' => 'Average', 'Average Sans' => 'Average Sans', 'Averia Gruesa Libre' => 'Averia Gruesa Libre', 'Averia Libre' => 'Averia Libre', 'Averia Sans Libre' => 'Averia Sans Libre', 'Averia Serif Libre' => 'Averia Serif Libre', 'Bad Script' => 'Bad Script', 'Balthazar' => 'Balthazar', 'Bangers' => 'Bangers', 'Basic' => 'Basic', 'BenchNine' => 'BenchNine', 'Battambang' => 'Battambang', 'Baumans' => 'Baumans', 'Bayon' => 'Bayon', 'Belgrano' => 'Belgrano', 'Belleza' => 'Belleza', 'Bentham' => 'Bentham', 'Berkshire Swash' => 'Berkshire Swash', 'Bevan' => 'Bevan', 'Bigelow Rules' => 'Bigelow Rules', 'Bigshot One' => 'Bigshot One', 'Bilbo' => 'Bilbo', 'Bilbo Swash Caps' => 'Bilbo Swash Caps', 'Bitter' => 'Bitter', 'Black Ops One' => 'Black Ops One', 'Bonbon' => 'Bonbon', 'Boogaloo' => 'Boogaloo', 'Bowlby One' => 'Bowlby One', 'Bowlby One SC' => 'Bowlby One SC', 'Brawler' => 'Brawler', 'Bree Serif' => 'Bree Serif', 'Bubblegum Sans' => 'Bubblegum Sans', 'Buda' => 'Buda', 'Buenard' => 'Buenard', 'Butcherman' => 'Butcherman', 'Butterfly Kids' => 'Butterfly Kids', 'Cabin' => 'Cabin', 'Cabin Condensed' => 'Cabin Condensed', 'Cabin Sketch' => 'Cabin Sketch', 'Caesar Dressing' => 'Caesar Dressing', 'Cagliostro' => 'Cagliostro', 'Calligraffitti' => 'Calligraffitti', 'Cambo' => 'Cambo', 'Candal' => 'Candal', 'Cantarell' => 'Cantarell', 'Cantata One' => 'Cantata One', 'Capriola' => 'Capriola', 'Cardo' => 'Cardo', 'Carme' => 'Carme', 'Carrois Gothic' => 'Carrois Gothic', 'Carrois Gothic SC' => 'Carrois Gothic SC', 'Carter One' => 'Carter One', 'Caudex' => 'Caudex', 'Cedarville Cursive' => 'Cedarville Cursive', 'Ceviche One' => 'Ceviche One', 'Changa One' => 'Changa One', 'Chango' => 'Chango', 'Chau Philomene One' => 'Chau Philomene One', 'Chela One' => 'Chela One', 'Chelsea Market' => 'Chelsea Market', 'Cherry Cream Soda' => 'Cherry Cream Soda', 'Cherry Swash' => 'Cherry Swash', 'Chewy' => 'Chewy', 'Chicle' => 'Chicle', 'Chivo' => 'Chivo', 'Cinzel' => 'Cinzel', 'Cinzel Decorative' => 'Cinzel Decorative', 'Clicker Script' => 'Clicker Script', 'Coda' => 'Coda', 'Coda Caption' => 'Coda Caption', 'Codystar' => 'Codystar', 'Combo' => 'Combo', 'Comfortaa' => 'Comfortaa', 'Coming Soon' => 'Coming Soon', 'Concert One' => 'Concert One', 'Condiment' => 'Condiment', 'Contrail One' => 'Contrail One', 'Convergence' => 'Convergence', 'Cookie' => 'Cookie', 'Copse' => 'Copse', 'Corben' => 'Corben', 'Courgette' => 'Courgette', 'Cousine' => 'Cousine', 'Coustard' => 'Coustard', 'Covered By Your Grace' => 'Covered By Your Grace', 'Crafty Girls' => 'Crafty Girls', 'Creepster' => 'Creepster', 'Crete Round' => 'Crete Round', 'Crimson Text' => 'Crimson Text', 'Croissant One' => 'Croissant One', 'Crushed' => 'Crushed', 'Cuprum' => 'Cuprum', 'Cutive' => 'Cutive', 'Cutive Mono' => 'Cutive Mono', 'Damion' => 'Damion', 'Dancing Script' => 'Dancing Script', 'Dawning of a New Day' => 'Dawning of a New Day', 'Days One' => 'Days One', 'Delius' => 'Delius', 'Delius Swash Caps' => 'Delius Swash Caps', 'Delius Unicase' => 'Delius Unicase', 'Della Respira' => 'Della Respira', 'Denk One' => 'Denk One', 'Devonshire' => 'Devonshire', 'Didact Gothic' => 'Didact Gothic', 'Diplomata' => 'Diplomata', 'Diplomata SC' => 'Diplomata SC', 'Domine' => 'Domine', 'Donegal One' => 'Donegal One', 'Doppio One' => 'Doppio One', 'Dorsa' => 'Dorsa', 'Dosis' => 'Dosis', 'Dr Sugiyama' => 'Dr Sugiyama', 'Droid Sans' => 'Droid Sans', 'Droid Sans Mono' => 'Droid Sans Mono', 'Droid Serif' => 'Droid Serif', 'Duru Sans' => 'Duru Sans', 'Dynalight' => 'Dynalight', 'EB Garamond' => 'EB Garamond', 'Eagle Lake' => 'Eagle Lake', 'Eater' => 'Eater', 'Economica' => 'Economica', 'Electrolize' => 'Electrolize', 'Elsie' => 'Elsie', 'Elsie Swash Caps' => 'Elsie Swash Caps', 'Emblema One' => 'Emblema One', 'Emilys Candy' => 'Emilys Candy', 'Engagement' => 'Engagement', 'Englebert' => 'Englebert', 'Enriqueta' => 'Enriqueta', 'Erica One' => 'Erica One', 'Esteban' => 'Esteban', 'Euphoria Script' => 'Euphoria Script', 'Ewert' => 'Ewert', 'Exo' => 'Exo', 'Expletus Sans' => 'Expletus Sans', 'Fanwood Text' => 'Fanwood Text', 'Fascinate' => 'Fascinate', 'Fascinate Inline' => 'Fascinate Inline', 'Faster One' => 'Faster One', 'Federant' => 'Federant', 'Federo' => 'Federo', 'Felipa' => 'Felipa', 'Fenix' => 'Fenix', 'Finger Paint' => 'Finger Paint', 'Fjalla One' => 'Fjalla One', 'Fjord One' => 'Fjord One', 'Flamenco' => 'Flamenco', 'Flavors' => 'Flavors', 'Fondamento' => 'Fondamento', 'Fontdiner Swanky' => 'Fontdiner Swanky', 'Forum' => 'Forum', 'Francois One' => 'Francois One', 'Fredericka the Great' => 'Fredericka the Great', 'Fredoka One' => 'Fredoka One', 'Fresca' => 'Fresca', 'Frijole' => 'Frijole', 'Fruktur' => 'Fruktur', 'Fugaz One' => 'Fugaz One', 'Gabriela' => 'Gabriela', 'Gafata' => 'Gafata', 'Galdeano' => 'Galdeano', 'Galindo' => 'Galindo', 'Gentium Basic' => 'Gentium Basic', 'Gentium Book Basic' => 'Gentium Book Basic', 'Geo' => 'Geo', 'Geostar' => 'Geostar', 'Geostar Fill' => 'Geostar Fill', 'Germania One' => 'Germania One', 'Gilda Display' => 'Gilda Display', 'Give You Glory' => 'Give You Glory', 'Glass Antiqua' => 'Glass Antiqua', 'Glegoo' => 'Glegoo', 'Gloria Hallelujah' => 'Gloria Hallelujah', 'Goblin One' => 'Goblin One', 'Gochi Hand' => 'Gochi Hand', 'Gorditas' => 'Gorditas', 'Goudy Bookletter 1911' => 'Goudy Bookletter 1911', 'Graduate' => 'Graduate', 'Grand Hotel' => 'Grand Hotel', 'Gravitas One' => 'Gravitas One', 'Great Vibes' => 'Great Vibes', 'Griffy' => 'Griffy', 'Gruppo' => 'Gruppo', 'Gudea' => 'Gudea', 'Habibi' => 'Habibi', 'Hammersmith One' => 'Hammersmith One', 'Hanalei' => 'Hanalei', 'Hanalei Fill' => 'Hanalei Fill', 'Handlee' => 'Handlee', 'Happy Monkey' => 'Happy Monkey', 'Headland One' => 'Headland One', 'Henny Penny' => 'Henny Penny', 'Herr Von Muellerhoff' => 'Herr Von Muellerhoff', 'Holtwood One SC' => 'Holtwood One SC', 'Homemade Apple' => 'Homemade Apple', 'Homenaje' => 'Homenaje', 'IM Fell DW Pica' => 'IM Fell DW Pica', 'IM Fell DW Pica SC' => 'IM Fell DW Pica SC', 'IM Fell Double Pica' => 'IM Fell Double Pica', 'IM Fell Double Pica SC' => 'IM Fell Double Pica SC', 'IM Fell English' => 'IM Fell English', 'IM Fell English SC' => 'IM Fell English SC', 'IM Fell French Canon' => 'IM Fell French Canon', 'IM Fell French Canon SC' => 'IM Fell French Canon SC', 'IM Fell Great Primer' => 'IM Fell Great Primer', 'IM Fell Great Primer SC' => 'IM Fell Great Primer SC', 'Iceberg' => 'Iceberg', 'Iceland' => 'Iceland', 'Imprima' => 'Imprima', 'Inconsolata' => 'Inconsolata', 'Inder' => 'Inder', 'Indie Flower' => 'Indie Flower', 'Inika' => 'Inika', 'Irish Grover' => 'Irish Grover', 'Istok Web' => 'Istok Web', 'Italiana' => 'Italiana', 'Italianno' => 'Italianno', 'Jacques Francois Shadow' => 'Jacques Francois Shadow', 'Jim Nightshade' => 'Jim Nightshade', 'Jockey One' => 'Jockey One', 'Jolly Lodger' => 'Jolly Lodger', 'Josefin Sans' => 'Josefin Sans', 'Josefin Slab' => 'Josefin Slab', 'Joti One' => 'Joti One', 'Judson' => 'Judson', 'Julee' => 'Julee', 'Julius Sans One' => 'Julius Sans One', 'Junge' => 'Junge', 'Jura' => 'Jura', 'Just Another Hand' => 'Just Another Hand', 'Just Me Again Down Here' => 'Just Me Again Down Here', 'Kameron' => 'Kameron', 'Karla' => 'Karla', 'Kaushan Script' => 'Kaushan Script', 'Kavoon' => 'Kavoon', 'Keania One' => 'Keania One', 'Kelly Slab' => 'Kelly Slab', 'Kenia' => 'Kenia', 'Kite One' => 'Kite One', 'Knewave' => 'Knewave', 'Kotta One' => 'Kotta One', 'Kranky' => 'Kranky', 'Kreon' => 'Kreon', 'Kristi' => 'Kristi', 'Krona One' => 'Krona One', 'La Belle Aurore' => 'La Belle Aurore', 'Lancelot' => 'Lancelot', 'Lato' => 'Lato', 'League Script' => 'League Script', 'Leckerli One' => 'Leckerli One', 'Ledger' => 'Ledger', 'Lekton' => 'Lekton', 'Lemon' => 'Lemon', 'Libre Baskerville' => 'Libre Baskerville', 'Life Savers' => 'Life Savers', 'Lilita One' => 'Lilita One', 'Limelight' => 'Limelight', 'Linden Hill' => 'Linden Hill', 'Lobster' => 'Lobster', 'Lobster Two' => 'Lobster Two', 'Londrina Outline' => 'Londrina Outline', 'Londrina Shadow' => 'Londrina Shadow', 'Londrina Sketch' => 'Londrina Sketch', 'Londrina Solid' => 'Londrina Solid', 'Lora' => 'Lora', 'Love Ya Like A Sister' => 'Love Ya Like A Sister', 'Loved by the King' => 'Loved by the King', 'Lovers Quarrel' => 'Lovers Quarrel', 'Luckiest Guy' => 'Luckiest Guy', 'Lusitana' => 'Lusitana', 'Lustria' => 'Lustria', 'Macondo' => 'Macondo', 'Macondo Swash Caps' => 'Macondo Swash Caps', 'Magra' => 'Magra', 'Maiden Orange' => 'Maiden Orange', 'Mako' => 'Mako', 'Marcellus' => 'Marcellus', 'Marcellus SC' => 'Marcellus SC', 'Marck Script' => 'Marck Script', 'Margarine' => 'Margarine', 'Marko One' => 'Marko One', 'Marmelad' => 'Marmelad', 'Marvel' => 'Marvel', 'Mate' => 'Mate', 'Mate SC' => 'Mate SC', 'Maven Pro' => 'Maven Pro', 'McLaren' => 'McLaren', 'Meddon' => 'Meddon', 'MedievalSharp' => 'MedievalSharp', 'Medula One' => 'Medula One', 'Megrim' => 'Megrim', 'Meie Script' => 'Meie Script', 'Merienda' => 'Merienda', 'Merienda One' => 'Merienda One', 'Merriweather' => 'Merriweather', 'Merriweather Sans' => 'Merriweather Sans', 'Metal Mania' => 'Metal Mania', 'Metamorphous' => 'Metamorphous', 'Metrophobic' => 'Metrophobic', 'Michroma' => 'Michroma', 'Milonga' => 'Milonga', 'Miltonian' => 'Miltonian', 'Miltonian Tattoo' => 'Miltonian Tattoo', 'Miniver' => 'Miniver', 'Miss Fajardose' => 'Miss Fajardose', 'Modern Antiqua' => 'Modern Antiqua', 'Molengo' => 'Molengo', 'Molle' => 'Molle', 'Monda' => 'Monda', 'Monofett' => 'Monofett', 'Monoton' => 'Monoton', 'Monsieur La Doulaise' => 'Monsieur La Doulaise', 'Montaga' => 'Montaga', 'Montez' => 'Montez', 'Montserrat' => 'Montserrat', 'Montserrat Alternates' => 'Montserrat Alternates', 'Montserrat Subrayada' => 'Montserrat Subrayada', 'Mountains of Christmas' => 'Mountains of Christmas', 'Mouse Memoirs' => 'Mouse Memoirs', 'Mr Bedfort' => 'Mr Bedfort', 'Mr Dafoe' => 'Mr Dafoe', 'Mr De Haviland' => 'Mr De Haviland', 'Mrs Saint Delafield' => 'Mrs Saint Delafield', 'Mrs Sheppards' => 'Mrs Sheppards', 'Muli' => 'Muli', 'Mystery Quest' => 'Mystery Quest', 'Neucha' => 'Neucha', 'Neuton' => 'Neuton', 'New Rocker' => 'New Rocker', 'News Cycle' => 'News Cycle', 'Niconne' => 'Niconne', 'Nixie One' => 'Nixie One', 'Nobile' => 'Nobile', 'Norican' => 'Norican', 'Nosifer' => 'Nosifer', 'Nothing You Could Do' => 'Nothing You Could Do', 'Noticia Text' => 'Noticia Text', 'Noto Sans' => 'Noto Sans', 'Noto Serif' => 'Noto Serif', 'Nova Cut' => 'Nova Cut', 'Nova Flat' => 'Nova Flat', 'Nova Mono' => 'Nova Mono', 'Nova Oval' => 'Nova Oval', 'Nova Round' => 'Nova Round', 'Nova Script' => 'Nova Script', 'Nova Slim' => 'Nova Slim', 'Nova Square' => 'Nova Square', 'Numans' => 'Numans', 'Nunito' => 'Nunito', 'Offside' => 'Offside', 'Old Standard TT' => 'Old Standard TT', 'Oldenburg' => 'Oldenburg', 'Oleo Script' => 'Oleo Script', 'Oleo Script Swash Caps' => 'Oleo Script Swash Caps', 'Open Sans' => 'Open Sans', 'Open Sans Condensed' => 'Open Sans Condensed', 'Oranienbaum' => 'Oranienbaum', 'Orbitron' => 'Orbitron', 'Oregano' => 'Oregano', 'Orienta' => 'Orienta', 'Original Surfer' => 'Original Surfer', 'Oswald' => 'Oswald', 'Over the Rainbow' => 'Over the Rainbow', 'Overlock' => 'Overlock', 'Overlock SC' => 'Overlock SC', 'Ovo' => 'Ovo', 'Oxygen' => 'Oxygen', 'PT Mono' => 'PT Mono', 'PT Sans' => 'PT Sans', 'PT Sans Caption' => 'PT Sans Caption', 'PT Sans Narrow' => 'PT Sans Narrow', 'PT Serif' => 'PT Serif', 'PT Serif Caption' => 'PT Serif Caption', 'Pacifico' => 'Pacifico', 'Paprika' => 'Paprika', 'Parisienne' => 'Parisienne', 'Passero One' => 'Passero One', 'Passion One' => 'Passion One', 'Patrick Hand' => 'Patrick Hand', 'Patrick Hand SC' => 'Patrick Hand SC', 'Patua One' => 'Patua One', 'Paytone One' => 'Paytone One', 'Peralta' => 'Peralta', 'Permanent Marker' => 'Permanent Marker', 'Petrona' => 'Petrona', 'Philosopher' => 'Philosopher', 'Piedra' => 'Piedra', 'Pinyon Script' => 'Pinyon Script', 'Pirata One' => 'Pirata One', 'Plaster' => 'Plaster', 'Play' => 'Play', 'Playball' => 'Playball', 'Playfair Display' => 'Playfair Display', 'Playfair Display SC' => 'Playfair Display SC', 'Podkova' => 'Podkova', 'Poiret One' => 'Poiret One', 'Poller One' => 'Poller One', 'Poly' => 'Poly', 'Pompiere' => 'Pompiere', 'Pontano Sans' => 'Pontano Sans', 'Port Lligat Sans' => 'Port Lligat Sans', 'Port Lligat Slab' => 'Port Lligat Slab', 'Prata' => 'Prata', 'Press Start 2P' => 'Press Start 2P', 'Princess Sofia' => 'Princess Sofia', 'Prociono' => 'Prociono', 'Prosto One' => 'Prosto One', 'Puritan' => 'Puritan', 'Quando' => 'Quando', 'Quantico' => 'Quantico', 'Quattrocento' => 'Quattrocento', 'Quattrocento Sans' => 'Quattrocento Sans', 'Questrial' => 'Questrial', 'Quicksand' => 'Quicksand', 'Quintessential' => 'Quintessential', 'Qwigley' => 'Qwigley', 'Racing Sans One' => 'Racing Sans One', 'Radley' => 'Radley', 'Raleway' => 'Raleway', 'Raleway Dots' => 'Raleway Dots', 'Rambla' => 'Rambla', 'Rammetto One' => 'Rammetto One', 'Ranchers' => 'Ranchers', 'Rancho' => 'Rancho', 'Rationale' => 'Rationale', 'Redressed' => 'Redressed', 'Reenie Beanie' => 'Reenie Beanie', 'Revalia' => 'Revalia', 'Ribeye' => 'Ribeye', 'Ribeye Marrow' => 'Ribeye Marrow', 'Righteous' => 'Righteous', 'Risque' => 'Risque', 'Roboto' => 'Roboto', 'Roboto Condensed' => 'Roboto Condensed', 'Rochester' => 'Rochester', 'Rock Salt' => 'Rock Salt', 'Rokkitt' => 'Rokkitt', 'Romanesco' => 'Romanesco', 'Ropa Sans' => 'Ropa Sans', 'Rosario' => 'Rosario', 'Rosarivo' => 'Rosarivo', 'Rouge Script' => 'Rouge Script', 'Ruda' => 'Ruda', 'Rufina' => 'Rufina', 'Ruge Boogie' => 'Ruge Boogie', 'Ruluko' => 'Ruluko', 'Rum Raisin' => 'Rum Raisin', 'Ruslan Display' => 'Ruslan Display', 'Russo One' => 'Russo One', 'Ruthie' => 'Ruthie', 'Rye' => 'Rye', 'Sacramento' => 'Sacramento', 'Sail' => 'Sail', 'Salsa' => 'Salsa', 'Sanchez' => 'Sanchez', 'Sancreek' => 'Sancreek', 'Sansita One' => 'Sansita One', 'Sarina' => 'Sarina', 'Satisfy' => 'Satisfy', 'Scada' => 'Scada', 'Schoolbell' => 'Schoolbell', 'Seaweed Script' => 'Seaweed Script', 'Sevillana' => 'Sevillana', 'Seymour One' => 'Seymour One', 'Shadows Into Light' => 'Shadows Into Light', 'Shadows Into Light Two' => 'Shadows Into Light Two', 'Shanti' => 'Shanti', 'Share' => 'Share', 'Share Tech' => 'Share Tech', 'Share Tech Mono' => 'Share Tech Mono', 'Shojumaru' => 'Shojumaru', 'Short Stack' => 'Short Stack', 'Sigmar One' => 'Sigmar One', 'Signika' => 'Signika', 'Signika Negative' => 'Signika Negative', 'Simonetta' => 'Simonetta', 'Sirin Stencil' => 'Sirin Stencil', 'Six Caps' => 'Six Caps', 'Slackey' => 'Slackey', 'Smokum' => 'Smokum', 'Smythe' => 'Smythe', 'Sniglet' => 'Sniglet', 'Snippet' => 'Snippet', 'Snowburst One' => 'Snowburst One', 'Sofadi One' => 'Sofadi One', 'Sofia' => 'Sofia', 'Sonsie One' => 'Sonsie One', 'Sorts Mill Goudy' => 'Sorts Mill Goudy', 'Source Code Pro' => 'Source Code Pro', 'Source Sans Pro' => 'Source Sans Pro', 'Special Elite' => 'Special Elite', 'Spicy Rice' => 'Spicy Rice', 'Spinnaker' => 'Spinnaker', 'Spirax' => 'Spirax', 'Squada One' => 'Squada One', 'Stalemate' => 'Stalemate', 'Stalinist One' => 'Stalinist One', 'Stardos Stencil' => 'Stardos Stencil', 'Stint Ultra Condensed' => 'Stint Ultra Condensed', 'Stint Ultra Expanded' => 'Stint Ultra Expanded', 'Stoke' => 'Stoke', 'Strait' => 'Strait', 'Sue Ellen Francisco' => 'Sue Ellen Francisco', 'Sunshiney' => 'Sunshiney', 'Supermercado One' => 'Supermercado One', 'Swanky and Moo Moo' => 'Swanky and Moo Moo', 'Syncopate' => 'Syncopate', 'Tangerine' => 'Tangerine', 'Tauri' => 'Tauri', 'Telex' => 'Telex', 'Tenor Sans' => 'Tenor Sans', 'The Girl Next Door' => 'The Girl Next Door', 'Tienne' => 'Tienne', 'Tinos' => 'Tinos', 'Titan One' => 'Titan One', 'Titillium Web' => 'Titillium Web', 'Trade Winds' => 'Trade Winds', 'Trocchi' => 'Trocchi', 'Trochut' => 'Trochut', 'Trykker' => 'Trykker', 'Tulpen One' => 'Tulpen One', 'Ubuntu' => 'Ubuntu', 'Ubuntu Condensed' => 'Ubuntu Condensed', 'Ubuntu Mono' => 'Ubuntu Mono', 'Ultra' => 'Ultra', 'Uncial Antiqua' => 'Uncial Antiqua', 'Underdog' => 'Underdog', 'Unica One' => 'Unica One', 'UnifrakturCook' => 'UnifrakturCook', 'UnifrakturMaguntia' => 'UnifrakturMaguntia', 'Unkempt' => 'Unkempt', 'Unlock' => 'Unlock', 'Unna' => 'Unna', 'VT323' => 'VT323', 'Vampiro One' => 'Vampiro One', 'Varela' => 'Varela', 'Varela Round' => 'Varela Round', 'Vast Shadow' => 'Vast Shadow', 'Vibur' => 'Vibur', 'Vidaloka' => 'Vidaloka', 'Viga' => 'Viga', 'Voces' => 'Voces', 'Volkhov' => 'Volkhov', 'Vollkorn' => 'Vollkorn', 'Voltaire' => 'Voltaire', 'Waiting for the Sunrise' => 'Waiting for the Sunrise', 'Wallpoet' => 'Wallpoet', 'Walter Turncoat' => 'Walter Turncoat', 'Warnes' => 'Warnes', 'Wellfleet' => 'Wellfleet', 'Wendy One' => 'Wendy One', 'Wire One' => 'Wire One', 'Yanone Kaffeesatz' => 'Yanone Kaffeesatz', 'Yellowtail' => 'Yellowtail', 'Yeseva One' => 'Yeseva One', 'Yesteryear' => 'Yesteryear', 'Zeyada' => 'Zeyada');

  if (array_key_exists($input, $font_families)) {
    return $input;
  } else {
    return '';
  }
}

// Font style
function melissa_sanitize_font_style($input) {
  $valid = array(
    'normal' => 'Normal',
    'normal-italic' => 'Normal Italic',
    'bold' => 'Bold',
    'bold-italic' => 'Bold Italic'
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return '';
  }
}

// Text transform
function melissa_sanitize_text_transform($input) {
  $valid = array(
    'capitalize' => 'Capitalize',
    'lowercase' => 'Lowercase',
    'uppercase' => 'Uppercase',
    'none' => 'None'
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return '';
  }
}

// HTML tag: a (wp_kses)
function melissa_sanitize_wp_kses_a($input) {
  return wp_kses($input,
    array(
      'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
      )
    )
  );
}

// HTML tags: b, br (wp_kses)
function melissa_sanitize_wp_kses_b_br($input) {
  return wp_kses($input,
    array(
      'b' => array(),
      'br' => array()
    )
  );
}

// HTML tags: span, strong, b, em, i (wp_kses)
function melissa_sanitize_wp_kses_html_tags_title($input) {
  return wp_kses($input,
    array(
      'span' => array(
        'class' => array()
      ),
      'strong' => array(),
      'b' => array(),
      'em' => array(),
      'i' => array(
        'class' => array()
      )
    )
  );
}

// HTML tags: a, span, strong, b, em, i, br (wp_kses)
function melissa_sanitize_wp_kses_html_tags_text($input) {
  return wp_kses($input,
    array(
      'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array(),
        'class' => array()
      ),
      'span' => array(
        'class' => array()
      ),
      'strong' => array(),
      'b' => array(),
      'em' => array(),
      'i' => array(
        'class' => array()
      ),
      'br' => array()
    )
  );
}

// Video type
function melissa_sanitize_header_video_type($input) {
  $valid = array(
    'youtube' => 'YouTube',
    'vimeo' => 'Vimeo',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'youtube';
  }
}

// Aspect ratio
function melissa_sanitize_header_video_aspect_ratio($input) {
  $valid = array(
    '4_3' => '4:3',
    '16_9' => '16:9',
  );

  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return '4_3';
  }
}

// Custom CSS code
function melissa_sanitize_custom_css($input) {
  if ($input != '') {
    return $input;
  } else {
    return '';
  }
}
