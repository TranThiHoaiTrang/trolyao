<?php if($template=='product/product_detail') { ?>
    <!-- Product -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<?=@$row_detail['ten'.$lang]?>",
            "image":
            [
                "<?= Helper::thumbnail_link(@$row_detail['photo'], 500, 500) ?>"
            ],
            "description": "<?=$seo->getSeo('description')?>",
            "sku":"SP0<?=@$row_detail['id']?>",
            "mpn": "925872",
            "brand":
            {
                "@type": "Thing",
                "name": "<?=(@$pro_list['ten'.$lang] != '') ? $pro_list['ten'.$lang] : $setting['ten'.$lang]?>"
            },
            "review":
            {
                "@type": "Review",
                "reviewRating":
                {
                    "@type": "Rating",
                    "ratingValue": "<?= $func->get_rating_schema(@$row_detail['id']) ?>",
                    "bestRating": "<?= $func->get_rating_number(@$row_detail['id']) ?>"
                },
                "author":
                {
                    "@type": "Person",
                    "name": "<?=@$setting['ten'.$lang]?>"
                }
            },
            "aggregateRating":
            {
                "@type": "AggregateRating",
                "ratingValue": "<?= $func->get_rating_schema(@$row_detail['id']) ?>",
                "reviewCount": "<?= $func->get_rating_number(@$row_detail['id']) ?>"
            },
            "offers":
            {
                "@type": "Offer",
                "url": "<?=$func->getCurrentPageURL_CANO()?>",
                "priceCurrency": "VND",
                "price": "<?=@$row_detail['gia']?>",
                "priceValidUntil": "2020-11-05",
                "itemCondition": "https://schema.org/UsedCondition",
                "availability": "https://schema.org/InStock",
                "seller":
                {
                    "@type": "Organization",
                    "name": "Executive Objects"
                }
            }
        }
    </script>
<?php } else if($template=='news/news_detail') { ?>
    <!-- News -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage":
            {
                "@type": "WebPage",
                "@id": "https://google.com/article"
            },
            "headline": "<?=@$row_detail['ten'.$lang]?>",
            "image":
            [
                "<?= Helper::thumbnail_link(@$row_detail['photo'], 500, 500) ?>"
            ],
            "datePublished": "<?=(new \DateTime(date("Y/m/d", @$row_detail['ngaytao'])))->format(DateTimeInterface::ATOM)?>",
            "dateModified": "<?=(new \DateTime(date("Y/m/d", @$row_detail['ngaysua'])))->format(DateTimeInterface::ATOM)?>",
            "author":
            {
                "@type": "Person",
                "name": "<?=@$setting['ten'.$lang]?>"
            },
            "publisher":
            {
                "@type": "Organization",
                "name": "Google",
                "logo":
                {
                    "@type": "ImageObject",
                    "url": "<?= Helper::thumbnail_link(@$logo['photo'], 500, 500) ?>"
                }
            },
            "description": "<?=$seo->getSeo('description')?>"
        }
    </script>
<?php } else if($template=='static/static') { ?>
    <!-- Static -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage":
            {
                "@type": "WebPage",
                "@id": "https://google.com/article"
            },
            "headline": "<?=@$static['ten'.$lang]?>",
            "image":
            [
                "<?= Helper::thumbnail_link(@$static['photo'], 500, 500) ?>"
            ],
            "datePublished": "<?=(new \DateTime(date("Y/m/d", @$static['ngaytao'])))->format(DateTimeInterface::ATOM)?>",
            "dateModified": "<?=(new \DateTime(date("Y/m/d", @$static['ngaysua'])))->format(DateTimeInterface::ATOM)?>",
            "author":
            {
                "@type": "Person",
                "name": "<?=@$setting['ten'.$lang]?>"
            },
            "publisher":
            {
                "@type": "Organization",
                "name": "Google",
                "logo":
                {
                    "@type": "ImageObject",
                    "url": "<?= Helper::thumbnail_link(@$logo['photo'], 500, 500) ?>"
                }
            },
            "description": "<?=$seo->getSeo('description')?>"
        }
    </script>
<?php } else { ?>
    <!-- General -->
    <script type="application/ld+json">
        {
            "@context" : "https://schema.org",
            "@type" : "Organization",
            "name" : "<?=@$setting['ten'.$lang]?>",
            "url" : "<?=$config_base?>",
            "sameAs" :
            [
                <?php if(isset($social) && count($social) > 0) { $sum_social = count($social); foreach($social as $key => $value) { ?>
                    "<?=@$value['link']?>"<?=(($key+1)<$sum_social)?',':''?>
                <?php } } ?>
            ],
            "address":
            {
                "@type": "PostalAddress",
                "streetAddress": "<?=$optsetting['diachi']?>",
                "addressRegion": "Ho Chi Minh",
                "postalCode": "70000",
                "addressCountry": "vi"
            }
        }
    </script>
<?php } ?>