<?php


namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    public function addTestimonial($text, $title)
    {

        $this->count++;
        if ($this->count % 2 == 1){
            $this->left_links[] = ["para" => $text, "cite" => $title];
        }
        else{
            $this->right_links[] = ["para" => $text, "cite" => $title];
        }



    }


    public function testimonials(){

        $html = <<<HTML

            <h2>TESTIMONIALS</h2>
            <div class="left">

HTML;

        foreach($this->left_links as $link) {

                $html .=
                '
                <blockquote>
                <p>' . $link['para'] . '</p>
                <cite>' . $link['cite']. '</cite>
                </blockquote>';
        }

        $html .= '</div>
                   <div class="right"> ';


        foreach($this->right_links as $link) {
                $html .=
                    '<blockquote>
                <p>' . $link['para'] . '</p>
                <cite>' . $link['cite']. '</cite>
                </blockquote>';
        }

        $html .= '</div>';

        return $html;

    }

    private $count = 0;
    private $left_links = [];
    private $right_links = [];
}