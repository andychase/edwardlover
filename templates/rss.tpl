<?xml version="1.0"?>
            <rss version="2.0">
                <channel>
                    <title>EdwardLover</title>
                    <link>http://edwardlover.com/rss.php</link>
                    <description>An Edward Cullen shoutboard -- How much do you love Edward?</description>
                    <language>en-us</language>
                    <pubDate>{$lastchanged}</pubDate>
                    <lastBuildDate>{$lastchanged}</lastBuildDate>
                    <docs>http://cyber.law.harvard.edu/rss/rss.html</docs>
{foreach from=$shouts item=shout}
                    <item>
                    <title>{$shout->name}</title>
                    <link>http://edwardlover.com/getone/{$shout->id}</link>
                    <guid>http://edwardlover.com/getone/{$shout->id}</guid>
                    <color>{$shout->color}</color>
                    <description>{$shout->body|truncate:140:"..."|strip_tags:false}</description>
                    </item>
{/foreach}
                    </channel>
            </rss>