
</div></div>


<div id="footer">
    <div class="container">
        <div class="row centered">
            <div class="col-md-4">
            <h4 style="padding-left: 20px"> Follow Us</h4>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-vk"></i></a>
            </div>

            <div class="col-md-4">
            <div class="news">
                <h4> Latest News</h4>
                <?
                $posts = R::find('posts', ' LIMIT 2 ',
                    array());
                 foreach ($posts as $post) :
                 ?>
                     <p><a href="post.php?id=<? echo($post['id']) ?>"><? echo($post['title']); ?></a>
                    <br><? echo($post['create_date']); ?></p>
                <? endforeach; ?>
            </div>
            </div>
            <div class="col-md-4">
                <div class="open">
                    <h4> Opening Hours</h4>
                    <p>Monday to Friday 9:00am - 18:00pm<br>
                        Saturday <span class="letter">9:00am - 16:00pm</span><br>
                        Sunday <span class="letter">9:00am - 14:00pm</span><br></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="templates/js/bootstrap.min.js"></script>
<script>
    feather.replace()
</script>
</body>
</html>
