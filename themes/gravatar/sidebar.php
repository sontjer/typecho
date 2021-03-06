<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary">
    <section class="widget">
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
            <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
            <button type="submit" class="submit"><?php _e('搜索'); ?></button>
        </form>
    </section>

    <?php if($this->is('post')): ?>

        <section class="widget article-catalog">
            <h3 class="widget-title"><?php _e('文章导航'); ?></h3>
            <ul class="widget-list">
                <?php if(isset($this->categories[0])): ?>
                    <?php $this->widget('Widget_Archive@myCustomCategory', 'type=category&pageSize=50', 'mid='.$this->categories[0]['mid'])->to($categoryPosts); $categoryPosts = array_reverse($categoryPosts->stack)?>
                    <?php while($categoryPost = current($categoryPosts)): next($categoryPosts); ?>
                        <li class="<?php if($this->cid === $categoryPost['cid']): ?> current <?php endif; ?>"><a itemprop="url" href="<?php echo $categoryPost['permalink'] ?>"><?php echo $categoryPost['title'] ?></a></li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </section>

    <?php else: ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('最新文章'); ?></h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Contents_Post_Recent')
                        ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('最近回复'); ?></h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                    <?php while($comments->next()): ?>
                        <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('分类'); ?></h3>
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('归档'); ?></h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
                        ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('其它'); ?></h3>
                <ul class="widget-list">
                    <?php if($this->user->hasLogin()): ?>
                        <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                        <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
                    <?php else: ?>
                        <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
                    <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
                </ul>
            </section>
        <?php endif; ?>

        <?php if ($this->options->links): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('链接'); ?></h3>
                <div>
                    <?php  _e($this->options->links()); ?>
                </div>
            </section>
        <?php endif; ?>

    <?php endif; ?>

</div><!-- end #sidebar -->
