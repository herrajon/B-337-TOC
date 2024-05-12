<?php
/*

..
..

B-337 TOC

D436 ()

..
..

*/
?>
<div id="modalnumberfour" class="M modal-frame shadow" data-modal-frame="four" >
	
	
	<?php if (($page->template() != "results") && ($page->template() != "tags") ): ?>

    <h2 class="modal-heading">Page TOC*</h2>

    <div class="R the-modal-content">

        <?php // snippet('k_subpages/subpages'); ?>

		<?php 
		
		$html = "";
		
		foreach ($page->kontent()->toLayouts() as $layout):
		
			$html .= "<section class='this-be-artikel-section section-layout layout-element layout-coloring beam-" . $layout->sectionwidthbar() . e($page->countheadings()->bool() == true , ' counting') . " element E / K' style='background-color: " . $layout->layout_background_color() . "; color: " . $layout->layout_text_color() . "; padding: " . $layout->layout_padding_topbottom(). "rem " . $layout->layout_padding_rightleft() . "rem;'>";
			$html .= "<div class='layout-room how-wide innri grid mx-auto " . $layout->sectionwidthbar() . " R' >";
		
			foreach ($layout->columns() as $column):
		
			$html .= $column->blocks();
		
			endforeach;
		
			$html .= "</div>";
			$html .= "</section>";
		
		endforeach;
		
		
	if (Str::length($html > 1)):
		$toc = new PHPTableOfContents($html);		
		
		echo '<div id="toc" class="toc">' . $toc->list() . '</div>';

	else:
		
		echo '<div style="padding: 4rem;">Markdown Doc</div>';
		
	endif; 
		?>


    </div>

	<?php endif;?>
</div>