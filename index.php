<?php
Kirby::plugin('white/b-337-toc', [
  'blueprints' => [
    'blocks/b-337-toc'   => __DIR__ . '/blueprints/blocks/b-337-toc.yml',
  ],
  'snippets' => [
    'blocks/b-337-toc'   => __DIR__ . '/snippets/blocks/b-337-toc.php',
    'b-337-toc-css'   => __DIR__ . '/snippets/b-337-toc-css.php',
  ],
]);
