<?php
/*

..
..

B-337 TOC

// Timestamp UTC

142/144/151/155/156/157/158/159/182/211/212/213/214/215/216/217

..
..

*/


?>

<div class="b-337 b-337-toc">
<h2><a href="#" class="toc-item"><?= $page->title() ?></a></h2>
<?php 
$all_headings = []; // Initialize an array to collect all headings from all columns
foreach ($page->kontent()->toLayouts() as $layout): 
    foreach ($layout->columns() as $column): 
        $content = $column->blocks()->toHtml(); // Convert blocks to HTML
        if (!empty($content)) {
            $dom = new DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $xpath = new DOMXPath($dom);
            $headings = $xpath->query('//h2 | //h3 | //h4 | //h5 | //h6');
            foreach ($headings as $heading) {
                $headingText = $heading->nodeValue;
                $headingSlug = str::slug($headingText);
                $headingTag = $heading->tagName;
                $all_headings[] = [
                    'text' => $headingText,
                    'slug' => $headingSlug,
                    'tag'  => $headingTag
                ];
            }
        }
    endforeach;
endforeach;

if (!empty($all_headings)) {
    $hierarchy = [0, 0, 0, 0, 0]; // Initialize an array to track the hierarchy with enough levels (for h2 to h6)
    echo "<ol>"; // Start ordered list for all collected headings
    foreach ($all_headings as $heading) {
        $level = intval(substr($heading['tag'], 1)) - 2; // Calculate the level index (0 for h2, 1 for h3, etc.)
        $hierarchy[$level]++; // Increment the current level
        for ($i = $level + 1; $i < count($hierarchy); $i++) {
            $hierarchy[$i] = 0; // Reset lower levels
        }
        $numbering = [];
        for ($i = 0; $i <= $level; $i++) {
            if ($hierarchy[$i] > 0) {
                $numbering[] = $hierarchy[$i];
            }
        }
        $numberingStr = implode('.', $numbering); // Create the numbering string
        $class = 'toc-item element-' . $heading['tag']; // Create class string based on the tag name
        echo "<li class='" . htmlspecialchars($class) . "'><a href='#" . htmlspecialchars($heading['slug']) . "'>" . htmlspecialchars($numberingStr . ' ' . $heading['text']) . "</a></li>";
    }
    echo "</ol>"; // End ordered list
}
?>
</div>


