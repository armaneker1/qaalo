<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>http://qaalo.com/</loc>
        <changefreq>always</changefreq>
    </url>
    <?php foreach($this->topics as $topic) { ?> 
    <url>
        <loc>http://qaalo.com/l/<?= $topic->getUrl()?></loc>
        <changefreq>always</changefreq>
        <priority>1.0</priority>
    </url>
    <?php } ?>
    
     <?php foreach($this->categories as $category) { ?> 
    <url>
        <loc>http://qaalo.com/c/<?= $category->getUrl()?></loc>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <?php } ?>
</urlset>