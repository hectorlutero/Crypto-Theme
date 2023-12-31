<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;

/**
 * A trait for handling single page application pages.
 */
trait IsSinglePageApplicationTrait
{
    /** @var string the app source, normally a URL */
    protected $appSource;

    /** @var string the identifier of the application */
    protected $appHandle;

    /** @var string ID of the div element inside which the page will be rendered */
    protected $divId;

    /** @var array<mixed> array of properties to be added to the host div */
    protected $divProperties = [];

    /** @var string String of styles to apply to the div hosting the application */
    protected $divStyles;

    /**
     * Renders the page HTML.
     *
     * @return void
     */
    public function render() : void
    {
        ?>
        <div id="<?php echo $this->divId; ?>" style="<?php echo $this->divStyles; ?>"></div>
        <?php
    }

    /**
     * Enqueues the single page application script.
     *
     * @return void
     * @throws Exception
     */
    public function enqueueApp() : void
    {
        $script = Enqueue::script()
            ->setHandle($this->appHandle)
            ->setSource($this->appSource)
            ->setDeferred(true);

        if (! empty($this->divProperties)) {
            $script->attachInlineScriptObject($this->appHandle)
                ->attachInlineScriptVariables($this->divProperties);
        }

        $script->execute();
    }
}
