
{{--<script type="text/javascript">--}}
{{--    jQuery(document).ready(function() {  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
{{--        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
{{--        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
{{--    })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');--}}

{{--        ga('create', 'UA-85998564-1', 'auto');--}}
{{--        ga('send', 'pageview');--}}
{{--    });--}}
{{--</script>--}}
<!--[if lte IE 8]>

<style>
    .attachment:focus {
        outline: #1e8cbe solid;
    }
    .selected.attachment {
        outline: #1e8cbe solid;
    }
</style>

<![endif]-->
{{--<script type="text/html" id="tmpl-media-frame">--}}
{{--    <div class="media-frame-title" id="media-frame-title"></div>--}}
{{--    <div class="media-frame-menu"></div>--}}
{{--    <div class="media-frame-router"></div>--}}
{{--    <div class="media-frame-content"></div>--}}
{{--    <div class="media-frame-toolbar"></div>--}}
{{--    <div class="media-frame-uploader"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-media-modal">--}}
{{--    <div tabindex="0" class="media-modal wp-core-ui" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">--}}
{{--        <# if ( data.hasCloseButton ) { #>--}}
{{--        <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text">Close dialog</span></span></button>--}}
{{--        <# } #>--}}
{{--        <div class="media-modal-content" role="document"></div>--}}
{{--    </div>--}}
{{--    <div class="media-modal-backdrop"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-uploader-window">--}}
{{--    <div class="uploader-window-content">--}}
{{--        <h1>Drop files to upload</h1>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-uploader-editor">--}}
{{--    <div class="uploader-editor-content">--}}
{{--        <div class="uploader-editor-title">Drop files to upload</div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-uploader-inline">--}}
{{--    <# var messageClass = data.message ? 'has-upload-message' : 'no-upload-message'; #>--}}
{{--    <# if ( data.canClose ) { #>--}}
{{--    <button class="close dashicons dashicons-no"><span class="screen-reader-text">Close uploader</span></button>--}}
{{--    <# } #>--}}
{{--    <div class="uploader-inline-content {{ messageClass }}">--}}
{{--        <# if ( data.message ) { #>--}}
{{--        <h2 class="upload-message">{{ data.message }}</h2>--}}
{{--        <# } #>--}}
{{--        <div class="upload-ui">--}}
{{--            <h2 class="upload-instructions drop-instructions">Drop files anywhere to upload</h2>--}}
{{--            <p class="upload-instructions drop-instructions">or</p>--}}
{{--            <button type="button" class="browser button button-hero">Select Files</button>--}}
{{--        </div>--}}

{{--        <div class="upload-inline-status"></div>--}}

{{--        <div class="post-upload-ui">--}}

{{--            <p class="max-upload-size">--}}
{{--                Maximum upload file size: 2 MB.				</p>--}}

{{--            <# if ( data.suggestedWidth && data.suggestedHeight ) { #>--}}
{{--            <p class="suggested-dimensions">--}}
{{--                Suggested image dimensions: {{data.suggestedWidth}} by {{data.suggestedHeight}} pixels.					</p>--}}
{{--            <# } #>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-media-library-view-switcher">--}}
{{--    <a href="/woffice/business/login/?mode=list" class="view-list">--}}
{{--        <span class="screen-reader-text">List View</span>--}}
{{--    </a>--}}
{{--    <a href="/woffice/business/login/?mode=grid" class="view-grid current">--}}
{{--        <span class="screen-reader-text">Grid View</span>--}}
{{--    </a>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-uploader-status">--}}
{{--    <h2>Uploading</h2>--}}
{{--    <button type="button" class="button-link upload-dismiss-errors"><span class="screen-reader-text">Dismiss Errors</span></button>--}}

{{--    <div class="media-progress-bar"><div></div></div>--}}
{{--    <div class="upload-details">--}}
{{--			<span class="upload-count">--}}
{{--				<span class="upload-index"></span> / <span class="upload-total"></span>--}}
{{--			</span>--}}
{{--        <span class="upload-detail-separator">&ndash;</span>--}}
{{--        <span class="upload-filename"></span>--}}
{{--    </div>--}}
{{--    <div class="upload-errors"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-uploader-status-error">--}}
{{--    <span class="upload-error-filename">{{{ data.filename }}}</span>--}}
{{--    <span class="upload-error-message">{{ data.message }}</span>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-edit-attachment-frame">--}}
{{--    <div class="edit-media-header">--}}
{{--        <button class="left dashicons <# if ( ! data.hasPrevious ) { #> disabled <# } #>"><span class="screen-reader-text">Edit previous media item</span></button>--}}
{{--        <button class="right dashicons <# if ( ! data.hasNext ) { #> disabled <# } #>"><span class="screen-reader-text">Edit next media item</span></button>--}}
{{--        <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text">Close dialog</span></span></button>--}}
{{--    </div>--}}
{{--    <div class="media-frame-title"></div>--}}
{{--    <div class="media-frame-content"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-attachment-details-two-column">--}}
{{--    <div class="attachment-media-view {{ data.orientation }}">--}}
{{--        <div class="thumbnail thumbnail-{{ data.type }}">--}}
{{--            <# if ( data.uploading ) { #>--}}
{{--            <div class="media-progress-bar"><div></div></div>--}}
{{--            <# } else if ( data.sizes && data.sizes.large ) { #>--}}
{{--            <img class="details-image" src="{{ data.sizes.large.url }}" draggable="false" alt="" />--}}
{{--            <# } else if ( data.sizes && data.sizes.full ) { #>--}}
{{--            <img class="details-image" src="{{ data.sizes.full.url }}" draggable="false" alt="" />--}}
{{--            <# } else if ( -1 === jQuery.inArray( data.type, [ 'audio', 'video' ] ) ) { #>--}}
{{--            <img class="details-image icon" src="{{ data.icon }}" draggable="false" alt="" />--}}
{{--            <# } #>--}}

{{--            <# if ( 'audio' === data.type ) { #>--}}
{{--            <div class="wp-media-wrapper">--}}
{{--                <audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">--}}
{{--                    <source type="{{ data.mime }}" src="{{ data.url }}"/>--}}
{{--                </audio>--}}
{{--            </div>--}}
{{--            <# } else if ( 'video' === data.type ) {--}}
{{--            var w_rule = '';--}}
{{--            if ( data.width ) {--}}
{{--            w_rule = 'width: ' + data.width + 'px;';--}}
{{--            } else if ( wp.media.view.settings.contentWidth ) {--}}
{{--            w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';--}}
{{--            }--}}
{{--            #>--}}
{{--            <div style="{{ w_rule }}" class="wp-media-wrapper wp-video">--}}
{{--                <video controls="controls" class="wp-video-shortcode" preload="metadata"--}}
{{--                <# if ( data.width ) { #>width="{{ data.width }}"<# } #>--}}
{{--                <# if ( data.height ) { #>height="{{ data.height }}"<# } #>--}}
{{--                <# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>--}}
{{--                <source type="{{ data.mime }}" src="{{ data.url }}"/>--}}
{{--                </video>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <div class="attachment-actions">--}}
{{--                <# if ( 'image' === data.type && ! data.uploading && data.sizes && data.can.save ) { #>--}}
{{--                <button type="button" class="button edit-attachment">Edit Image</button>--}}
{{--                <# } else if ( 'pdf' === data.subtype && data.sizes ) { #>--}}
{{--                Document Preview					<# } #>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="attachment-info">--}}
{{--			<span class="settings-save-status">--}}
{{--				<span class="spinner"></span>--}}
{{--				<span class="saved">Saved.</span>--}}
{{--			</span>--}}
{{--        <div class="details">--}}
{{--            <div class="filename"><strong>File name:</strong> {{ data.filename }}</div>--}}
{{--            <div class="filename"><strong>File type:</strong> {{ data.mime }}</div>--}}
{{--            <div class="uploaded"><strong>Uploaded on:</strong> {{ data.dateFormatted }}</div>--}}

{{--            <div class="file-size"><strong>File size:</strong> {{ data.filesizeHumanReadable }}</div>--}}
{{--            <# if ( 'image' === data.type && ! data.uploading ) { #>--}}
{{--            <# if ( data.width && data.height ) { #>--}}
{{--            <div class="dimensions"><strong>Dimensions:</strong>--}}
{{--                {{ data.width }} by {{ data.height }} pixels						</div>--}}
{{--            <# } #>--}}
{{--            <# } #>--}}

{{--            <# if ( data.fileLength && data.fileLengthHumanReadable ) { #>--}}
{{--            <div class="file-length"><strong>Length:</strong>--}}
{{--                <span aria-hidden="true">{{ data.fileLength }}</span>--}}
{{--                <span class="screen-reader-text">{{ data.fileLengthHumanReadable }}</span>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <# if ( 'audio' === data.type && data.meta.bitrate ) { #>--}}
{{--            <div class="bitrate">--}}
{{--                <strong>Bitrate:</strong> {{ Math.round( data.meta.bitrate / 1000 ) }}kb/s--}}
{{--                <# if ( data.meta.bitrate_mode ) { #>--}}
{{--                {{ ' ' + data.meta.bitrate_mode.toUpperCase() }}--}}
{{--                <# } #>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <div class="compat-meta">--}}
{{--                <# if ( data.compat && data.compat.meta ) { #>--}}
{{--                {{{ data.compat.meta }}}--}}
{{--                <# } #>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="settings">--}}
{{--            <# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>--}}
{{--            <# if ( 'image' === data.type ) { #>--}}
{{--            <label class="setting" data-setting="alt">--}}
{{--                <span class="name">Alternative Text</span>--}}
{{--                <input type="text" value="{{ data.alt }}" aria-describedby="alt-text-description" {{ maybeReadOnly }} />--}}
{{--            </label>--}}
{{--            <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener noreferrer">Describe the purpose of the image<span class="screen-reader-text"> (opens in a new tab)</span></a>. Leave empty if the image is purely decorative.</p>--}}
{{--            <# } #>--}}
{{--            <label class="setting" data-setting="title">--}}
{{--                <span class="name">Title</span>--}}
{{--                <input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />--}}
{{--            </label>--}}
{{--            <# if ( 'audio' === data.type ) { #>--}}
{{--            <label class="setting" data-setting="artist">--}}
{{--                <span class="name">Artist</span>--}}
{{--                <input type="text" value="{{ data.artist || data.meta.artist || '' }}" />--}}
{{--            </label>--}}
{{--            <label class="setting" data-setting="album">--}}
{{--                <span class="name">Album</span>--}}
{{--                <input type="text" value="{{ data.album || data.meta.album || '' }}" />--}}
{{--            </label>--}}
{{--            <# } #>--}}
{{--            <label class="setting" data-setting="caption">--}}
{{--                <span class="name">Caption</span>--}}
{{--                <textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>--}}
{{--            </label>--}}
{{--            <label class="setting" data-setting="description">--}}
{{--                <span class="name">Description</span>--}}
{{--                <textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>--}}
{{--            </label>--}}
{{--            <div class="setting">--}}
{{--                <span class="name">Uploaded By</span>--}}
{{--                <span class="value">{{ data.authorName }}</span>--}}
{{--            </div>--}}
{{--            <# if ( data.uploadedToTitle ) { #>--}}
{{--            <div class="setting">--}}
{{--                <span class="name">Uploaded To</span>--}}
{{--                <# if ( data.uploadedToLink ) { #>--}}
{{--                <span class="value"><a href="{{ data.uploadedToLink }}">{{ data.uploadedToTitle }}</a></span>--}}
{{--                <# } else { #>--}}
{{--                <span class="value">{{ data.uploadedToTitle }}</span>--}}
{{--                <# } #>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <label class="setting" data-setting="url">--}}
{{--                <span class="name">Copy Link</span>--}}
{{--                <input type="text" value="{{ data.url }}" readonly />--}}
{{--            </label>--}}
{{--            <div class="attachment-compat"></div>--}}
{{--        </div>--}}

{{--        <div class="actions">--}}
{{--            <a class="view-attachment" href="{{ data.link }}">View attachment page</a>--}}
{{--            <# if ( data.can.save ) { #> |--}}
{{--            <a href="{{ data.editLink }}">Edit more details</a>--}}
{{--            <# } #>--}}
{{--            <# if ( ! data.uploading && data.can.remove ) { #> |--}}
{{--            <button type="button" class="button-link delete-attachment">Delete Permanently</button>--}}
{{--            <# } #>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-attachment">--}}
{{--    <div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">--}}
{{--        <div class="thumbnail">--}}
{{--            <# if ( data.uploading ) { #>--}}
{{--            <div class="media-progress-bar"><div style="width: {{ data.percent }}%"></div></div>--}}
{{--            <# } else if ( 'image' === data.type && data.sizes ) { #>--}}
{{--            <div class="centered">--}}
{{--                <img src="{{ data.size.url }}" draggable="false" alt="" />--}}
{{--            </div>--}}
{{--            <# } else { #>--}}
{{--            <div class="centered">--}}
{{--                <# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>--}}
{{--                <img src="{{ data.image.src }}" class="thumbnail" draggable="false" alt="" />--}}
{{--                <# } else if ( data.sizes && data.sizes.medium ) { #>--}}
{{--                <img src="{{ data.sizes.medium.url }}" class="thumbnail" draggable="false" alt="" />--}}
{{--                <# } else { #>--}}
{{--                <img src="{{ data.icon }}" class="icon" draggable="false" alt="" />--}}
{{--                <# } #>--}}
{{--            </div>--}}
{{--            <div class="filename">--}}
{{--                <div>{{ data.filename }}</div>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--        </div>--}}
{{--        <# if ( data.buttons.close ) { #>--}}
{{--        <button type="button" class="button-link attachment-close media-modal-icon"><span class="screen-reader-text">Remove</span></button>--}}
{{--        <# } #>--}}
{{--    </div>--}}
{{--    <# if ( data.buttons.check ) { #>--}}
{{--    <button type="button" class="check" tabindex="-1"><span class="media-modal-icon"></span><span class="screen-reader-text">Deselect</span></button>--}}
{{--    <# } #>--}}
{{--    <#--}}
{{--    var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';--}}
{{--    if ( data.describe ) {--}}
{{--    if ( 'image' === data.type ) { #>--}}
{{--    <input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"--}}
{{--           placeholder="Caption this image&hellip;" {{ maybeReadOnly }} />--}}
{{--    <# } else { #>--}}
{{--    <input type="text" value="{{ data.title }}" class="describe" data-setting="title"--}}
{{--    <# if ( 'video' === data.type ) { #>--}}
{{--    placeholder="Describe this video&hellip;"--}}
{{--    <# } else if ( 'audio' === data.type ) { #>--}}
{{--    placeholder="Describe this audio file&hellip;"--}}
{{--    <# } else { #>--}}
{{--    placeholder="Describe this media file&hellip;"--}}
{{--    <# } #> {{ maybeReadOnly }} />--}}
{{--    <# }--}}
{{--    } #>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-attachment-details">--}}
{{--    <h2>--}}
{{--        Attachment Details			<span class="settings-save-status">--}}
{{--				<span class="spinner"></span>--}}
{{--				<span class="saved">Saved.</span>--}}
{{--			</span>--}}
{{--    </h2>--}}
{{--    <div class="attachment-info">--}}
{{--        <div class="thumbnail thumbnail-{{ data.type }}">--}}
{{--            <# if ( data.uploading ) { #>--}}
{{--            <div class="media-progress-bar"><div></div></div>--}}
{{--            <# } else if ( 'image' === data.type && data.sizes ) { #>--}}
{{--            <img src="{{ data.size.url }}" draggable="false" alt="" />--}}
{{--            <# } else { #>--}}
{{--            <img src="{{ data.icon }}" class="icon" draggable="false" alt="" />--}}
{{--            <# } #>--}}
{{--        </div>--}}
{{--        <div class="details">--}}
{{--            <div class="filename">{{ data.filename }}</div>--}}
{{--            <div class="uploaded">{{ data.dateFormatted }}</div>--}}

{{--            <div class="file-size">{{ data.filesizeHumanReadable }}</div>--}}
{{--            <# if ( 'image' === data.type && ! data.uploading ) { #>--}}
{{--            <# if ( data.width && data.height ) { #>--}}
{{--            <div class="dimensions">--}}
{{--                {{ data.width }} by {{ data.height }} pixels						</div>--}}
{{--            <# } #>--}}

{{--            <# if ( data.can.save && data.sizes ) { #>--}}
{{--            <a class="edit-attachment" href="{{ data.editLink }}&amp;image-editor" target="_blank">Edit Image</a>--}}
{{--            <# } #>--}}
{{--            <# } #>--}}

{{--            <# if ( data.fileLength && data.fileLengthHumanReadable ) { #>--}}
{{--            <div class="file-length">Length:						<span aria-hidden="true">{{ data.fileLength }}</span>--}}
{{--                <span class="screen-reader-text">{{ data.fileLengthHumanReadable }}</span>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <# if ( ! data.uploading && data.can.remove ) { #>--}}
{{--            <button type="button" class="button-link delete-attachment">Delete Permanently</button>--}}
{{--            <# } #>--}}

{{--            <div class="compat-meta">--}}
{{--                <# if ( data.compat && data.compat.meta ) { #>--}}
{{--                {{{ data.compat.meta }}}--}}
{{--                <# } #>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>--}}
{{--    <# if ( 'image' === data.type ) { #>--}}
{{--    <label class="setting" data-setting="alt">--}}
{{--        <span class="name">Alt Text</span>--}}
{{--        <input type="text" value="{{ data.alt }}" aria-describedby="alt-text-description" {{ maybeReadOnly }} />--}}
{{--    </label>--}}
{{--    <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener noreferrer">Describe the purpose of the image<span class="screen-reader-text"> (opens in a new tab)</span></a>. Leave empty if the image is purely decorative.</p>--}}
{{--    <# } #>--}}
{{--    <label class="setting" data-setting="title">--}}
{{--        <span class="name">Title</span>--}}
{{--        <input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />--}}
{{--    </label>--}}
{{--    <# if ( 'audio' === data.type ) { #>--}}
{{--    <label class="setting" data-setting="artist">--}}
{{--        <span class="name">Artist</span>--}}
{{--        <input type="text" value="{{ data.artist || data.meta.artist || '' }}" />--}}
{{--    </label>--}}
{{--    <label class="setting" data-setting="album">--}}
{{--        <span class="name">Album</span>--}}
{{--        <input type="text" value="{{ data.album || data.meta.album || '' }}" />--}}
{{--    </label>--}}
{{--    <# } #>--}}
{{--    <label class="setting" data-setting="caption">--}}
{{--        <span class="name">Caption</span>--}}
{{--        <textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>--}}
{{--    </label>--}}
{{--    <label class="setting" data-setting="description">--}}
{{--        <span class="name">Description</span>--}}
{{--        <textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>--}}
{{--    </label>--}}
{{--    <label class="setting" data-setting="url">--}}
{{--        <span class="name">Copy Link</span>--}}
{{--        <input type="text" value="{{ data.url }}" readonly />--}}
{{--    </label>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-media-selection">--}}
{{--    <div class="selection-info">--}}
{{--        <span class="count"></span>--}}
{{--        <# if ( data.editable ) { #>--}}
{{--        <button type="button" class="button-link edit-selection">Edit Selection</button>--}}
{{--        <# } #>--}}
{{--        <# if ( data.clearable ) { #>--}}
{{--        <button type="button" class="button-link clear-selection">Clear</button>--}}
{{--        <# } #>--}}
{{--    </div>--}}
{{--    <div class="selection-view"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-attachment-display-settings">--}}
{{--    <h2>Attachment Display Settings</h2>--}}

{{--    <# if ( 'image' === data.type ) { #>--}}
{{--    <label class="setting align">--}}
{{--        <span>Alignment</span>--}}
{{--        <select class="alignment"--}}
{{--                data-setting="align"--}}
{{--        <# if ( data.userSettings ) { #>--}}
{{--        data-user-setting="align"--}}
{{--        <# } #>>--}}

{{--        <option value="left">--}}
{{--            Left					</option>--}}
{{--        <option value="center">--}}
{{--            Center					</option>--}}
{{--        <option value="right">--}}
{{--            Right					</option>--}}
{{--        <option value="none" selected>--}}
{{--            None					</option>--}}
{{--        </select>--}}
{{--    </label>--}}
{{--    <# } #>--}}

{{--    <div class="setting">--}}
{{--        <label>--}}
{{--            <# if ( data.model.canEmbed ) { #>--}}
{{--            <span>Embed or Link</span>--}}
{{--            <# } else { #>--}}
{{--            <span>Link To</span>--}}
{{--            <# } #>--}}

{{--            <select class="link-to"--}}
{{--                    data-setting="link"--}}
{{--            <# if ( data.userSettings && ! data.model.canEmbed ) { #>--}}
{{--            data-user-setting="urlbutton"--}}
{{--            <# } #>>--}}

{{--            <# if ( data.model.canEmbed ) { #>--}}
{{--            <option value="embed" selected>--}}
{{--                Embed Media Player					</option>--}}
{{--            <option value="file">--}}
{{--                <# } else { #>--}}
{{--            <option value="none" selected>--}}
{{--                None					</option>--}}
{{--            <option value="file">--}}
{{--                <# } #>--}}
{{--                <# if ( data.model.canEmbed ) { #>--}}
{{--                Link to Media File					<# } else { #>--}}
{{--                Media File					<# } #>--}}
{{--            </option>--}}
{{--            <option value="post">--}}
{{--                <# if ( data.model.canEmbed ) { #>--}}
{{--                Link to Attachment Page					<# } else { #>--}}
{{--                Attachment Page					<# } #>--}}
{{--            </option>--}}
{{--            <# if ( 'image' === data.type ) { #>--}}
{{--            <option value="custom">--}}
{{--                Custom URL					</option>--}}
{{--            <# } #>--}}
{{--            </select>--}}
{{--        </label>--}}
{{--        <input type="text" class="link-to-custom" data-setting="linkUrl" />--}}
{{--    </div>--}}

{{--    <# if ( 'undefined' !== typeof data.sizes ) { #>--}}
{{--    <label class="setting">--}}
{{--        <span>Size</span>--}}
{{--        <select class="size" name="size"--}}
{{--                data-setting="size"--}}
{{--        <# if ( data.userSettings ) { #>--}}
{{--        data-user-setting="imgsize"--}}
{{--        <# } #>>--}}
{{--        <#--}}
{{--        var size = data.sizes['thumbnail'];--}}
{{--        if ( size ) { #>--}}
{{--        <option value="thumbnail" >--}}
{{--            Thumbnail &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--        </option>--}}
{{--        <# } #>--}}
{{--        <#--}}
{{--        var size = data.sizes['medium'];--}}
{{--        if ( size ) { #>--}}
{{--        <option value="medium" >--}}
{{--            Medium &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--        </option>--}}
{{--        <# } #>--}}
{{--        <#--}}
{{--        var size = data.sizes['large'];--}}
{{--        if ( size ) { #>--}}
{{--        <option value="large" >--}}
{{--            Large &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--        </option>--}}
{{--        <# } #>--}}
{{--        <#--}}
{{--        var size = data.sizes['full'];--}}
{{--        if ( size ) { #>--}}
{{--        <option value="full"  selected='selected'>--}}
{{--            Full Size &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--        </option>--}}
{{--        <# } #>--}}
{{--        </select>--}}
{{--    </label>--}}
{{--    <# } #>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-gallery-settings">--}}
{{--    <h2>Gallery Settings</h2>--}}

{{--    <label class="setting">--}}
{{--        <span>Link To</span>--}}
{{--        <select class="link-to"--}}
{{--                data-setting="link"--}}
{{--        <# if ( data.userSettings ) { #>--}}
{{--        data-user-setting="urlbutton"--}}
{{--        <# } #>>--}}

{{--        <option value="post" <# if ( ! wp.media.galleryDefaults.link || 'post' == wp.media.galleryDefaults.link ) {--}}
{{--        #>selected="selected"<# }--}}
{{--        #>>--}}
{{--        Attachment Page				</option>--}}
{{--        <option value="file" <# if ( 'file' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>--}}
{{--        Media File				</option>--}}
{{--        <option value="none" <# if ( 'none' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>--}}
{{--        None				</option>--}}
{{--        </select>--}}
{{--    </label>--}}

{{--    <label class="setting">--}}
{{--        <span>Columns</span>--}}
{{--        <select class="columns" name="columns"--}}
{{--                data-setting="columns">--}}
{{--            <option value="1" <#--}}
{{--            if ( 1 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            1					</option>--}}
{{--            <option value="2" <#--}}
{{--            if ( 2 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            2					</option>--}}
{{--            <option value="3" <#--}}
{{--            if ( 3 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            3					</option>--}}
{{--            <option value="4" <#--}}
{{--            if ( 4 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            4					</option>--}}
{{--            <option value="5" <#--}}
{{--            if ( 5 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            5					</option>--}}
{{--            <option value="6" <#--}}
{{--            if ( 6 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            6					</option>--}}
{{--            <option value="7" <#--}}
{{--            if ( 7 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            7					</option>--}}
{{--            <option value="8" <#--}}
{{--            if ( 8 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            8					</option>--}}
{{--            <option value="9" <#--}}
{{--            if ( 9 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }--}}
{{--            #>>--}}
{{--            9					</option>--}}
{{--        </select>--}}
{{--    </label>--}}

{{--    <label class="setting">--}}
{{--        <span>Random Order</span>--}}
{{--        <input type="checkbox" data-setting="_orderbyRandom" />--}}
{{--    </label>--}}

{{--    <label class="setting size">--}}
{{--        <span>Size</span>--}}
{{--        <select class="size" name="size"--}}
{{--                data-setting="size"--}}
{{--        <# if ( data.userSettings ) { #>--}}
{{--        data-user-setting="imgsize"--}}
{{--        <# } #>--}}
{{--        >--}}
{{--        <option value="thumbnail">--}}
{{--            Thumbnail					</option>--}}
{{--        <option value="medium">--}}
{{--            Medium					</option>--}}
{{--        <option value="large">--}}
{{--            Large					</option>--}}
{{--        <option value="full">--}}
{{--            Full Size					</option>--}}
{{--        </select>--}}
{{--    </label>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-playlist-settings">--}}
{{--    <h2>Playlist Settings</h2>--}}

{{--    <# var emptyModel = _.isEmpty( data.model ),--}}
{{--    isVideo = 'video' === data.controller.get('library').props.get('type'); #>--}}

{{--    <label class="setting">--}}
{{--        <input type="checkbox" data-setting="tracklist" <# if ( emptyModel ) { #>--}}
{{--        checked="checked"--}}
{{--        <# } #> />--}}
{{--        <# if ( isVideo ) { #>--}}
{{--        <span>Show Video List</span>--}}
{{--        <# } else { #>--}}
{{--        <span>Show Tracklist</span>--}}
{{--        <# } #>--}}
{{--    </label>--}}

{{--    <# if ( ! isVideo ) { #>--}}
{{--    <label class="setting">--}}
{{--        <input type="checkbox" data-setting="artists" <# if ( emptyModel ) { #>--}}
{{--        checked="checked"--}}
{{--        <# } #> />--}}
{{--        <span>Show Artist Name in Tracklist</span>--}}
{{--    </label>--}}
{{--    <# } #>--}}

{{--    <label class="setting">--}}
{{--        <input type="checkbox" data-setting="images" <# if ( emptyModel ) { #>--}}
{{--        checked="checked"--}}
{{--        <# } #> />--}}
{{--        <span>Show Images</span>--}}
{{--    </label>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-embed-link-settings">--}}
{{--    <label class="setting link-text">--}}
{{--        <span>Link Text</span>--}}
{{--        <input type="text" class="alignment" data-setting="linkText" />--}}
{{--    </label>--}}
{{--    <div class="embed-container" style="display: none;">--}}
{{--        <div class="embed-preview"></div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-embed-image-settings">--}}
{{--    <div class="thumbnail">--}}
{{--        <img src="{{ data.model.url }}" draggable="false" alt="" />--}}
{{--    </div>--}}

{{--    <label class="setting alt-text has-description">--}}
{{--        <span>Alternative Text</span>--}}
{{--        <input type="text" data-setting="alt" aria-describedby="alt-text-description" />--}}
{{--    </label>--}}
{{--    <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener noreferrer">Describe the purpose of the image<span class="screen-reader-text"> (opens in a new tab)</span></a>. Leave empty if the image is purely decorative.</p>--}}

{{--    <label class="setting caption">--}}
{{--        <span>Caption</span>--}}
{{--        <textarea data-setting="caption" />--}}
{{--    </label>--}}

{{--    <div class="setting align">--}}
{{--        <span>Align</span>--}}
{{--        <div class="button-group button-large" data-setting="align">--}}
{{--            <button class="button" value="left">--}}
{{--                Left				</button>--}}
{{--            <button class="button" value="center">--}}
{{--                Center				</button>--}}
{{--            <button class="button" value="right">--}}
{{--                Right				</button>--}}
{{--            <button class="button active" value="none">--}}
{{--                None				</button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="setting link-to">--}}
{{--        <span>Link To</span>--}}
{{--        <div class="button-group button-large" data-setting="link">--}}
{{--            <button class="button" value="file">--}}
{{--                Image URL				</button>--}}
{{--            <button class="button" value="custom">--}}
{{--                Custom URL				</button>--}}
{{--            <button class="button active" value="none">--}}
{{--                None				</button>--}}
{{--        </div>--}}
{{--        <input type="text" class="link-to-custom" data-setting="linkUrl" />--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-image-details">--}}
{{--    <div class="media-embed">--}}
{{--        <div class="embed-media-settings">--}}
{{--            <div class="column-image">--}}
{{--                <div class="image">--}}
{{--                    <img src="{{ data.model.url }}" draggable="false" alt="" />--}}

{{--                    <# if ( data.attachment && window.imageEdit ) { #>--}}
{{--                    <div class="actions">--}}
{{--                        <input type="button" class="edit-attachment button" value="Edit Original" />--}}
{{--                        <input type="button" class="replace-attachment button" value="Replace" />--}}
{{--                    </div>--}}
{{--                    <# } #>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="column-settings">--}}
{{--                <label class="setting alt-text has-description">--}}
{{--                    <span>Alternative Text</span>--}}
{{--                    <input type="text" data-setting="alt" value="{{ data.model.alt }}" aria-describedby="alt-text-description" />--}}
{{--                </label>--}}
{{--                <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener noreferrer">Describe the purpose of the image<span class="screen-reader-text"> (opens in a new tab)</span></a>. Leave empty if the image is purely decorative.</p>--}}

{{--                <label class="setting caption">--}}
{{--                    <span>Caption</span>--}}
{{--                    <textarea data-setting="caption">{{ data.model.caption }}</textarea>--}}
{{--                </label>--}}

{{--                <h2>Display Settings</h2>--}}
{{--                <div class="setting align">--}}
{{--                    <span>Align</span>--}}
{{--                    <div class="button-group button-large" data-setting="align">--}}
{{--                        <button class="button" value="left">--}}
{{--                            Left							</button>--}}
{{--                        <button class="button" value="center">--}}
{{--                            Center							</button>--}}
{{--                        <button class="button" value="right">--}}
{{--                            Right							</button>--}}
{{--                        <button class="button active" value="none">--}}
{{--                            None							</button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <# if ( data.attachment ) { #>--}}
{{--                <# if ( 'undefined' !== typeof data.attachment.sizes ) { #>--}}
{{--                <label class="setting size">--}}
{{--                    <span>Size</span>--}}
{{--                    <select class="size" name="size"--}}
{{--                            data-setting="size"--}}
{{--                    <# if ( data.userSettings ) { #>--}}
{{--                    data-user-setting="imgsize"--}}
{{--                    <# } #>>--}}
{{--                    <#--}}
{{--                    var size = data.sizes['thumbnail'];--}}
{{--                    if ( size ) { #>--}}
{{--                    <option value="thumbnail">--}}
{{--                        Thumbnail &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--                    </option>--}}
{{--                    <# } #>--}}
{{--                    <#--}}
{{--                    var size = data.sizes['medium'];--}}
{{--                    if ( size ) { #>--}}
{{--                    <option value="medium">--}}
{{--                        Medium &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--                    </option>--}}
{{--                    <# } #>--}}
{{--                    <#--}}
{{--                    var size = data.sizes['large'];--}}
{{--                    if ( size ) { #>--}}
{{--                    <option value="large">--}}
{{--                        Large &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--                    </option>--}}
{{--                    <# } #>--}}
{{--                    <#--}}
{{--                    var size = data.sizes['full'];--}}
{{--                    if ( size ) { #>--}}
{{--                    <option value="full">--}}
{{--                        Full Size &ndash; {{ size.width }} &times; {{ size.height }}--}}
{{--                    </option>--}}
{{--                    <# } #>--}}
{{--                    <option value="custom">--}}
{{--                        Custom Size									</option>--}}
{{--                    </select>--}}
{{--                </label>--}}
{{--                <# } #>--}}
{{--                <div class="custom-size<# if ( data.model.size !== 'custom' ) { #> hidden<# } #>">--}}
{{--                    <label><span>Width <small>(px)</small></span> <input data-setting="customWidth" type="number" step="1" value="{{ data.model.customWidth }}" /></label><span class="sep">&times;</span><label><span>Height <small>(px)</small></span><input data-setting="customHeight" type="number" step="1" value="{{ data.model.customHeight }}" /></label>--}}
{{--                </div>--}}
{{--                <# } #>--}}

{{--                <div class="setting link-to">--}}
{{--                    <span>Link To</span>--}}
{{--                    <select data-setting="link">--}}
{{--                        <# if ( data.attachment ) { #>--}}
{{--                        <option value="file">--}}
{{--                            Media File							</option>--}}
{{--                        <option value="post">--}}
{{--                            Attachment Page							</option>--}}
{{--                        <# } else { #>--}}
{{--                        <option value="file">--}}
{{--                            Image URL							</option>--}}
{{--                        <# } #>--}}
{{--                        <option value="custom">--}}
{{--                            Custom URL							</option>--}}
{{--                        <option value="none">--}}
{{--                            None							</option>--}}
{{--                    </select>--}}
{{--                    <input type="text" class="link-to-custom" data-setting="linkUrl" />--}}
{{--                </div>--}}
{{--                <div class="advanced-section">--}}
{{--                    <h2><button type="button" class="button-link advanced-toggle">Advanced Options</button></h2>--}}
{{--                    <div class="advanced-settings hidden">--}}
{{--                        <div class="advanced-image">--}}
{{--                            <label class="setting title-text">--}}
{{--                                <span>Image Title Attribute</span>--}}
{{--                                <input type="text" data-setting="title" value="{{ data.model.title }}" />--}}
{{--                            </label>--}}
{{--                            <label class="setting extra-classes">--}}
{{--                                <span>Image CSS Class</span>--}}
{{--                                <input type="text" data-setting="extraClasses" value="{{ data.model.extraClasses }}" />--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="advanced-link">--}}
{{--                            <div class="setting link-target">--}}
{{--                                <label><input type="checkbox" data-setting="linkTargetBlank" value="_blank" <# if ( data.model.linkTargetBlank ) { #>checked="checked"<# } #>>Open link in a new tab</label>--}}
{{--                            </div>--}}
{{--                            <label class="setting link-rel">--}}
{{--                                <span>Link Rel</span>--}}
{{--                                <input type="text" data-setting="linkRel" value="{{ data.model.linkRel }}" />--}}
{{--                            </label>--}}
{{--                            <label class="setting link-class-name">--}}
{{--                                <span>Link CSS Class</span>--}}
{{--                                <input type="text" data-setting="linkClassName" value="{{ data.model.linkClassName }}" />--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-image-editor">--}}
{{--    <div id="media-head-{{ data.id }}"></div>--}}
{{--    <div id="image-editor-{{ data.id }}"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-audio-details">--}}
{{--    <# var ext, html5types = {--}}
{{--    mp3: wp.media.view.settings.embedMimes.mp3,--}}
{{--    ogg: wp.media.view.settings.embedMimes.ogg--}}
{{--    }; #>--}}

{{--    <div class="media-embed media-embed-details">--}}
{{--        <div class="embed-media-settings embed-audio-settings">--}}
{{--            <audio style="visibility: hidden"--}}
{{--                   controls--}}
{{--                   class="wp-audio-shortcode"--}}
{{--                   width="{{ _.isUndefined( data.model.width ) ? 400 : data.model.width }}"--}}
{{--                   preload="{{ _.isUndefined( data.model.preload ) ? 'none' : data.model.preload }}"--}}
{{--            <#--}}
{{--            if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {--}}
{{--            #> autoplay<#--}}
{{--            }--}}
{{--            if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {--}}
{{--            #> loop<#--}}
{{--            }--}}
{{--            #>--}}
{{--            >--}}
{{--            <# if ( ! _.isEmpty( data.model.src ) ) { #>--}}
{{--            <source src="{{ data.model.src }}" type="{{ wp.media.view.settings.embedMimes[ data.model.src.split('.').pop() ] }}" />--}}
{{--            <# } #>--}}

{{--            <# if ( ! _.isEmpty( data.model.mp3 ) ) { #>--}}
{{--            <source src="{{ data.model.mp3 }}" type="{{ wp.media.view.settings.embedMimes[ 'mp3' ] }}" />--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.ogg ) ) { #>--}}
{{--            <source src="{{ data.model.ogg }}" type="{{ wp.media.view.settings.embedMimes[ 'ogg' ] }}" />--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.flac ) ) { #>--}}
{{--            <source src="{{ data.model.flac }}" type="{{ wp.media.view.settings.embedMimes[ 'flac' ] }}" />--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.m4a ) ) { #>--}}
{{--            <source src="{{ data.model.m4a }}" type="{{ wp.media.view.settings.embedMimes[ 'm4a' ] }}" />--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.wav ) ) { #>--}}
{{--            <source src="{{ data.model.wav }}" type="{{ wp.media.view.settings.embedMimes[ 'wav' ] }}" />--}}
{{--            <# } #>--}}
{{--            </audio>--}}

{{--            <# if ( ! _.isEmpty( data.model.src ) ) {--}}
{{--            ext = data.model.src.split('.').pop();--}}
{{--            if ( html5types[ ext ] ) {--}}
{{--            delete html5types[ ext ];--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="audio-source">URL</label>--}}
{{--                <input type="text" id="audio-source" readonly data-setting="src" value="{{ data.model.src }}" />--}}
{{--                <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.mp3 ) ) {--}}
{{--            if ( ! _.isUndefined( html5types.mp3 ) ) {--}}
{{--            delete html5types.mp3;--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="mp3-source">MP3</span>--}}
{{--                    <input type="text" id="mp3-source" readonly data-setting="mp3" value="{{ data.model.mp3 }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.ogg ) ) {--}}
{{--            if ( ! _.isUndefined( html5types.ogg ) ) {--}}
{{--            delete html5types.ogg;--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="ogg-source">OGG</span>--}}
{{--                    <input type="text" id="ogg-source" readonly data-setting="ogg" value="{{ data.model.ogg }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.flac ) ) {--}}
{{--            if ( ! _.isUndefined( html5types.flac ) ) {--}}
{{--            delete html5types.flac;--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="flac-source">FLAC</span>--}}
{{--                    <input type="text" id="flac-source" readonly data-setting="flac" value="{{ data.model.flac }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.m4a ) ) {--}}
{{--            if ( ! _.isUndefined( html5types.m4a ) ) {--}}
{{--            delete html5types.m4a;--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="m4a-source">M4A</span>--}}
{{--                    <input type="text" id="m4a-source" readonly data-setting="m4a" value="{{ data.model.m4a }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <# if ( ! _.isEmpty( data.model.wav ) ) {--}}
{{--            if ( ! _.isUndefined( html5types.wav ) ) {--}}
{{--            delete html5types.wav;--}}
{{--            }--}}
{{--            #>--}}
{{--            <div class="setting">--}}
{{--                <label for="wav-source">WAV</span>--}}
{{--                    <input type="text" id="wav-source" readonly data-setting="wav" value="{{ data.model.wav }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove audio source</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <# if ( ! _.isEmpty( html5types ) ) { #>--}}
{{--            <div class="setting">--}}
{{--                <span>Add alternate sources for maximum HTML5 playback:</span>--}}
{{--                <div class="button-large">--}}
{{--                    <# _.each( html5types, function (mime, type) { #>--}}
{{--                    <button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>--}}
{{--                    <# } ) #>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <div class="setting preload">--}}
{{--                <span>Preload</span>--}}
{{--                <div class="button-group button-large" data-setting="preload">--}}
{{--                    <button class="button" value="auto">Auto</button>--}}
{{--                    <button class="button" value="metadata">Metadata</button>--}}
{{--                    <button class="button active" value="none">None</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <label class="setting checkbox-setting autoplay">--}}
{{--                <input type="checkbox" data-setting="autoplay" />--}}
{{--                <span>Autoplay</span>--}}
{{--            </label>--}}

{{--            <label class="setting checkbox-setting">--}}
{{--                <input type="checkbox" data-setting="loop" />--}}
{{--                <span>Loop</span>--}}
{{--            </label>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-video-details">--}}
{{--    <# var ext, html5types = {--}}
{{--    mp4: wp.media.view.settings.embedMimes.mp4,--}}
{{--    ogv: wp.media.view.settings.embedMimes.ogv,--}}
{{--    webm: wp.media.view.settings.embedMimes.webm--}}
{{--    }; #>--}}

{{--    <div class="media-embed media-embed-details">--}}
{{--        <div class="embed-media-settings embed-video-settings">--}}
{{--            <div class="wp-video-holder">--}}
{{--                <#--}}
{{--                var w = ! data.model.width || data.model.width > 640 ? 640 : data.model.width,--}}
{{--                h = ! data.model.height ? 360 : data.model.height;--}}

{{--                if ( data.model.width && w !== data.model.width ) {--}}
{{--                h = Math.ceil( ( h * w ) / data.model.width );--}}
{{--                }--}}
{{--                #>--}}

{{--                <#  var w_rule = '', classes = [],--}}
{{--                w, h, settings = wp.media.view.settings,--}}
{{--                isYouTube = isVimeo = false;--}}

{{--                if ( ! _.isEmpty( data.model.src ) ) {--}}
{{--                isYouTube = data.model.src.match(/youtube|youtu\.be/);--}}
{{--                isVimeo = -1 !== data.model.src.indexOf('vimeo');--}}
{{--                }--}}

{{--                if ( settings.contentWidth && data.model.width >= settings.contentWidth ) {--}}
{{--                w = settings.contentWidth;--}}
{{--                } else {--}}
{{--                w = data.model.width;--}}
{{--                }--}}

{{--                if ( w !== data.model.width ) {--}}
{{--                h = Math.ceil( ( data.model.height * w ) / data.model.width );--}}
{{--                } else {--}}
{{--                h = data.model.height;--}}
{{--                }--}}

{{--                if ( w ) {--}}
{{--                w_rule = 'width: ' + w + 'px; ';--}}
{{--                }--}}

{{--                if ( isYouTube ) {--}}
{{--                classes.push( 'youtube-video' );--}}
{{--                }--}}

{{--                if ( isVimeo ) {--}}
{{--                classes.push( 'vimeo-video' );--}}
{{--                }--}}

{{--                #>--}}
{{--                <div style="{{ w_rule }}" class="wp-video">--}}
{{--                    <video controls--}}
{{--                           class="wp-video-shortcode {{ classes.join( ' ' ) }}"--}}
{{--                    <# if ( w ) { #>width="{{ w }}"<# } #>--}}
{{--                    <# if ( h ) { #>height="{{ h }}"<# } #>--}}
{{--                    <#--}}
{{--                    if ( ! _.isUndefined( data.model.poster ) && data.model.poster ) {--}}
{{--                    #> poster="{{ data.model.poster }}"<#--}}
{{--                    } #>--}}
{{--                    preload			="{{ _.isUndefined( data.model.preload ) ? 'metadata' : data.model.preload }}"--}}
{{--                    <#--}}
{{--                    if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {--}}
{{--                    #> autoplay<#--}}
{{--                    }--}}
{{--                    if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {--}}
{{--                    #> loop<#--}}
{{--                    }--}}
{{--                    #>--}}
{{--                    >--}}
{{--                    <# if ( ! _.isEmpty( data.model.src ) ) {--}}
{{--                    if ( isYouTube ) { #>--}}
{{--                    <source src="{{ data.model.src }}" type="video/youtube" />--}}
{{--                    <# } else if ( isVimeo ) { #>--}}
{{--                    <source src="{{ data.model.src }}" type="video/vimeo" />--}}
{{--                    <# } else { #>--}}
{{--                    <source src="{{ data.model.src }}" type="{{ settings.embedMimes[ data.model.src.split('.').pop() ] }}" />--}}
{{--                    <# }--}}
{{--                    } #>--}}

{{--                    <# if ( data.model.mp4 ) { #>--}}
{{--                    <source src="{{ data.model.mp4 }}" type="{{ settings.embedMimes[ 'mp4' ] }}" />--}}
{{--                    <# } #>--}}
{{--                    <# if ( data.model.m4v ) { #>--}}
{{--                    <source src="{{ data.model.m4v }}" type="{{ settings.embedMimes[ 'm4v' ] }}" />--}}
{{--                    <# } #>--}}
{{--                    <# if ( data.model.webm ) { #>--}}
{{--                    <source src="{{ data.model.webm }}" type="{{ settings.embedMimes[ 'webm' ] }}" />--}}
{{--                    <# } #>--}}
{{--                    <# if ( data.model.ogv ) { #>--}}
{{--                    <source src="{{ data.model.ogv }}" type="{{ settings.embedMimes[ 'ogv' ] }}" />--}}
{{--                    <# } #>--}}
{{--                    <# if ( data.model.flv ) { #>--}}
{{--                    <source src="{{ data.model.flv }}" type="{{ settings.embedMimes[ 'flv' ] }}" />--}}
{{--                    <# } #>--}}
{{--                    {{{ data.model.content }}}--}}
{{--                    </video>--}}
{{--                </div>--}}

{{--                <# if ( ! _.isEmpty( data.model.src ) ) {--}}
{{--                ext = data.model.src.split('.').pop();--}}
{{--                if ( html5types[ ext ] ) {--}}
{{--                delete html5types[ ext ];--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="video-source">URL</label>--}}
{{--                    <input type="text" id="video-source" readonly data-setting="src" value="{{ data.model.src }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--                <# if ( ! _.isEmpty( data.model.mp4 ) ) {--}}
{{--                if ( ! _.isUndefined( html5types.mp4 ) ) {--}}
{{--                delete html5types.mp4;--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="mp4-source">MP4</label>--}}
{{--                    <input type="text" id="mp4-source" readonly data-setting="mp4" value="{{ data.model.mp4 }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--                <# if ( ! _.isEmpty( data.model.m4v ) ) {--}}
{{--                if ( ! _.isUndefined( html5types.m4v ) ) {--}}
{{--                delete html5types.m4v;--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="m4v-source">M4V</label>--}}
{{--                    <input type="text" id="m4v-source" readonly data-setting="m4v" value="{{ data.model.m4v }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--                <# if ( ! _.isEmpty( data.model.webm ) ) {--}}
{{--                if ( ! _.isUndefined( html5types.webm ) ) {--}}
{{--                delete html5types.webm;--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="webm-source">WEBM</label>--}}
{{--                    <input type="text" id="webm-source" readonly data-setting="webm" value="{{ data.model.webm }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--                <# if ( ! _.isEmpty( data.model.ogv ) ) {--}}
{{--                if ( ! _.isUndefined( html5types.ogv ) ) {--}}
{{--                delete html5types.ogv;--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="ogv-source">OGV</label>--}}
{{--                    <input type="text" id="ogv-source" readonly data-setting="ogv" value="{{ data.model.ogv }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--                <# if ( ! _.isEmpty( data.model.flv ) ) {--}}
{{--                if ( ! _.isUndefined( html5types.flv ) ) {--}}
{{--                delete html5types.flv;--}}
{{--                }--}}
{{--                #>--}}
{{--                <div class="setting">--}}
{{--                    <label for="flv-source">FLV</label>--}}
{{--                    <input type="text" id="flv-source" readonly data-setting="flv" value="{{ data.model.flv }}" />--}}
{{--                    <button type="button" class="button-link remove-setting">Remove video source</button>--}}
{{--                </div>--}}
{{--                <# } #>--}}
{{--            </div>--}}

{{--            <# if ( ! _.isEmpty( html5types ) ) { #>--}}
{{--            <div class="setting">--}}
{{--                <span>Add alternate sources for maximum HTML5 playback:</span>--}}
{{--                <div class="button-large">--}}
{{--                    <# _.each( html5types, function (mime, type) { #>--}}
{{--                    <button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>--}}
{{--                    <# } ) #>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <# } #>--}}

{{--            <# if ( ! _.isEmpty( data.model.poster ) ) { #>--}}
{{--            <div class="setting">--}}
{{--                <label for="poster-image">Poster Image</label>--}}
{{--                <input type="text" id="poster-image" readonly data-setting="poster" value="{{ data.model.poster }}" />--}}
{{--                <button type="button" class="button-link remove-setting">Remove poster image</button>--}}
{{--            </div>--}}
{{--            <# } #>--}}
{{--            <div class="setting preload">--}}
{{--                <span>Preload</span>--}}
{{--                <div class="button-group button-large" data-setting="preload">--}}
{{--                    <button class="button" value="auto">Auto</button>--}}
{{--                    <button class="button" value="metadata">Metadata</button>--}}
{{--                    <button class="button active" value="none">None</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <label class="setting checkbox-setting autoplay">--}}
{{--                <input type="checkbox" data-setting="autoplay" />--}}
{{--                <span>Autoplay</span>--}}
{{--            </label>--}}

{{--            <label class="setting checkbox-setting">--}}
{{--                <input type="checkbox" data-setting="loop" />--}}
{{--                <span>Loop</span>--}}
{{--            </label>--}}

{{--            <div class="setting" data-setting="content">--}}
{{--                <#--}}
{{--                var content = '';--}}
{{--                if ( ! _.isEmpty( data.model.content ) ) {--}}
{{--                var tracks = jQuery( data.model.content ).filter( 'track' );--}}
{{--                _.each( tracks.toArray(), function (track) {--}}
{{--                content += track.outerHTML; #>--}}
{{--                <label for="video-track">Tracks (subtitles, captions, descriptions, chapters, or metadata)</span>--}}
{{--                    <input class="content-track" type="text" id="video-track" readonly value="{{ track.outerHTML }}" />--}}
{{--                    <button type="button" class="button-link remove-setting remove-track">Remove video track</button>--}}
{{--                    <# } ); #>--}}
{{--                    <# } else { #>--}}
{{--                    <span>Tracks (subtitles, captions, descriptions, chapters, or metadata)</span>--}}
{{--                    <em>There are no associated subtitles.</em>--}}
{{--                    <# } #>--}}
{{--                    <textarea class="hidden content-setting">{{ content }}</textarea>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-editor-gallery">--}}
{{--    <# if ( data.attachments.length ) { #>--}}
{{--    <div class="gallery gallery-columns-{{ data.columns }}">--}}
{{--        <# _.each( data.attachments, function( attachment, index ) { #>--}}
{{--        <dl class="gallery-item">--}}
{{--            <dt class="gallery-icon">--}}
{{--                <# if ( attachment.thumbnail ) { #>--}}
{{--                <img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" alt="{{ attachment.alt }}" />--}}
{{--                <# } else { #>--}}
{{--                <img src="{{ attachment.url }}" alt="{{ attachment.alt }}" />--}}
{{--                <# } #>--}}
{{--            </dt>--}}
{{--            <# if ( attachment.caption ) { #>--}}
{{--            <dd class="wp-caption-text gallery-caption">--}}
{{--                {{{ data.verifyHTML( attachment.caption ) }}}--}}
{{--            </dd>--}}
{{--            <# } #>--}}
{{--        </dl>--}}
{{--        <# if ( index % data.columns === data.columns - 1 ) { #>--}}
{{--        <br style="clear: both;">--}}
{{--        <# } #>--}}
{{--        <# } ); #>--}}
{{--    </div>--}}
{{--    <# } else { #>--}}
{{--    <div class="wpview-error">--}}
{{--        <div class="dashicons dashicons-format-gallery"></div><p>No items found.</p>--}}
{{--    </div>--}}
{{--    <# } #>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-crop-content">--}}
{{--    <img class="crop-image" src="{{ data.url }}" alt="Image crop area preview. Requires mouse interaction.">--}}
{{--    <div class="upload-errors"></div>--}}
{{--</script>--}}

{{--<script type="text/html" id="tmpl-site-icon-preview">--}}
{{--    <h2>Preview</h2>--}}
{{--    <strong aria-hidden="true">As a browser icon</strong>--}}
{{--    <div class="favicon-preview">--}}
{{--        <img src="https://demos.alkalab.com/woffice/business/wp-admin/images/browser.png" class="browser-preview" width="182" height="" alt="" />--}}

{{--        <div class="favicon">--}}
{{--            <img id="preview-favicon" src="{{ data.url }}" alt="Preview as a browser icon"/>--}}
{{--        </div>--}}
{{--        <span class="browser-title" aria-hidden="true">Woffice Intranet</span>--}}
{{--    </div>--}}

{{--    <strong aria-hidden="true">As an app icon</strong>--}}
{{--    <div class="app-icon-preview">--}}
{{--        <img id="preview-app-icon" src="{{ data.url }}" alt="Preview as an app icon"/>--}}
{{--    </div>--}}
{{--</script>--}}

<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/bbpress/templates/default/js/editor.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var BP_Nouveau = {
        // "ajaxurl":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-admin\/admin-ajax.php",
        "ajaxurl":"http:\/\/swot.test\/user_ajax",
        "confirm":"Are you sure?",
        "show_x_comments":"Show all %d comments",
        "unsaved_changes":"Your profile has unsaved changes. If you leave the page, the changes will be lost.",
        "object_nav_parent":"#buddypress",
        "objects":["activity","members","groups","xprofile","friends","messages","settings","notifications","group_members","group_requests"],
        "nonces":{
            "activity":"1b0b65c057",
            "members":"1bd69cc5b2",
            "groups":"a4986f9b63",
            "xprofile":"6aed114de3",
            "friends":"0ce81433fa",
            "messages":"a9caf43bc9",
            "settings":"a3c6732bfd",
            "notifications":"63dc1e3493"
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/buddypress/bp-templates/bp-nouveau/js/buddypress-nouveau.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/comment-reply.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wpcf7 = {"apiSettings":{"root":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"}};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/contact-form-7/includes/js/scripts.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/core.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/widget.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/position.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/menu.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/wp-sanitize.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/wp-a11y.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var uiAutocompleteL10n = {"noResults":"No results found.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate.","itemSelected":"Item selected."};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/autocomplete.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/underscore.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var WOFFICE = {
        // "ajax_url":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-admin\/admin-ajax.php",
        "ajax_url":"http:\/\/swot.test\/user_ajax",
        "site_url":"https:\/\/demos.alkalab.com\/woffice\/business",
        "user_id":"0",
        "masonry_refresh_delay":"2000",
        "menu_threshold":"992",
        "cookie_allowed":{"sidebar":true},
        "alert_timeout":"4000",
        "has_live_search":"1",
        "input_location_bb":"field_2"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/themes/woffice/js/woffice.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var WOFFICE_EVENTS = {
        // "ajax_url":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-admin\/admin-ajax.php",
        "ajax_url":"http:\/\/swot.test\/user_ajax",
        "nonce":"923a70a17f",
        "fetch_action":"woffice_events_fetch",
        "add_action":"woffice_events_create",
        "edit_action":"woffice_events_edit",
        "events_download":"woffice_events_download",
        "previous_month":"Previous month",
        "next_month":"Next month",
        "export_events":"Export events",
        "full_day":"Full day",
        "day_names":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        "short_day_names":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
        "month_names":["January","February","March","April","May","June","July","August","September","October","November","December"],
        "starting_day":"Monday",
        "month":"09",
        "year":"2019",
        "day":"28",
        "available_days":["monday","tuesday","wednesday","thursday","friday","saturday","sunday"],
        "fields":["woffice_event_title","woffice_event_date_start","woffice_event_date_end","woffice_event_repeat","woffice_event_color","woffice_event_visibility","woffice_event_description","woffice_event_location","woffice_event_link","new_event_label","event_repeat_end_date_label","edit_event_label","new_event_btn_save","event_btn_save","woffice_event_image_label","create_event_label","event_chose_file_label","import_ics_file_label","user","advanced_settings","less_settings"],
        "enable_event":"1",
        "field_options":{
            "woffice_event_title":
                {
                    "type":"text",
                    "label":"Title",
                    "desc":"Set event name.",
                    "fw-storage":{
                        "type":"post-meta","post-meta":"fw_option:woffice_event_title"
                    }
                },"woffice_event_date_start":{
                "type":"datetime-picker",
                "label":"Event Starting Date",
                "desc":"Will be used to display this event in the calendar.",
                "min-date":"1-0-2000",
                "datetime-picker":{
                    "format":"Y-m-d H:i","minDate":0
                },"fw-storage":{
                    "type":"post-meta",
                    "post-meta":"fw_option:woffice_event_date_start"
                }
            },
            "woffice_event_date_end":{
                "type":"datetime-picker",
                "label":"Event Ending Date",
                "desc":"Will be used to display this event in the calendar.",
                "datetime-picker":{
                    "format":"Y-m-d H:i","minDate":0
                },"fw-storage":{
                    "type":"post-meta",
                    "post-meta":"fw_option:woffice_event_date_end"
                }
            },
            "woffice_event_repeat":{
                "type":"select",
                "label":"Repeat",
                "desc":"Select repeat type, Choose no if not repeatable event.",
                "choices":{"No":"No","Daily":"Daily","Weekly":"Weekly","Monthly":"Monthly","Yearly":"Yearly"},
                "value":"No",
                "fw-storage":{
                    "type":"post-meta",
                    "post-meta":"fw_option:woffice_event_repeat"
                }
            },
            "woffice_event_color":{
                "type":"select",
                "label":"Event Color",
                "desc":"Event color in calendar.",
                "choices":{
                    "default":"default",
                    "blue":"blue",
                    "orange":"orange",
                    "red":"red",
                    "green":"green",
                    "grey":"grey"
                },
                "value":"default",
                "fw-storage":{
                    "type":"post-meta",
                    "post-meta":"fw_option:woffice_event_color"
                }
            },
            "woffice_event_visibility":{
                "type":"select",
                "label":"Event Visibility",
                "desc":"Set Event Visibility.",
                "choices":{"personal":"Personal"},
                "value":"personal",
                "fw-storage":{"type":"post-meta","post-meta":"fw_option:woffice_event_visibility"}
            },
            "woffice_event_description":{"type":"textarea","label":"Description","fw-storage":{"type":"post-meta","post-meta":"fw_option:woffice_event_description"}},"woffice_event_location":{"type":"text","label":"Location","desc":"Location of the event.","fw-storage":{"type":"post-meta","post-meta":"fw_option:woffice_event_location"}},"woffice_event_link":{"type":"text","label":"Event URL","desc":"URL of the event.","fw-storage":{"type":"post-meta","post-meta":"fw_option:woffice_event_link"}},"new_event_label":"Add a new event","event_repeat_end_date_label":"Repeat until","edit_event_label":"Edit event","new_event_btn_save":"Create event","event_btn_save":"Save event","woffice_event_image_label":"Event image","create_event_label":"CREATE A NEW EVENT","event_chose_file_label":"Upload event image","import_ics_file_label":"Import .ics file instead","user":0,"advanced_settings":"Advanced settings","less_settings":"Collapse"}};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/woffice-core/extensions/woffice-event/static/js/events.vue.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/woffice-core/extensions/woffice-event/static/js/moment.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/woffice-core/extensions/woffice-event/static/js/jquery.datetimepicker.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/plugins/woffice-core/extensions/woffice-poll/static/js/woffice-poll-scripts.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-content/themes/woffice/js/fixed-nav.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/shortcode.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/backbone.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpUtilSettings = {
        "ajax":{
            // "url":"\/woffice\/business\/wp-admin\/admin-ajax.php"
            "url":"http:\/\/swot.test\/user_ajax",
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/wp-util.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/wp-backbone.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpMediaModelsL10n = {
        "settings":{
            // "ajaxurl":"\/woffice\/business\/wp-admin\/admin-ajax.php",
            "ajaxurl":"http:\/\/swot.test\/user_ajax",
            "post":{"id":0}
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/media-models.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var pluploadL10n = {"queue_limit_exceeded":"You have attempted to queue too many files.","file_exceeds_size_limit":"%s exceeds the maximum upload size for this site.","zero_byte_file":"This file is empty. Please try another.","invalid_filetype":"Sorry, this file type is not permitted for security reasons.","not_an_image":"This file is not an image. Please try another.","image_memory_exceeded":"Memory exceeded. Please try another smaller file.","image_dimensions_exceeded":"This is larger than the maximum size. Please try another.","default_error":"An error occurred in the upload. Please try again later.","missing_upload_url":"There was a configuration error. Please contact the server administrator.","upload_limit_exceeded":"You may only upload 1 file.","http_error":"HTTP error.","upload_failed":"Upload failed.","big_upload_failed":"Please try uploading this file with the %1$sbrowser uploader%2$s.","big_upload_queued":"%s exceeds the maximum upload size for the multi-file uploader when used in your browser.","io_error":"IO error.","security_error":"Security error.","file_cancelled":"File canceled.","upload_stopped":"Upload stopped.","dismiss":"Dismiss","crunching":"Crunching\u2026","deleted":"moved to the trash.","error_uploading":"\u201c%s\u201d has failed to upload."};
    var _wpPluploadSettings = {"defaults":{"file_data_name":"async-upload","url":"\/woffice\/business\/wp-admin\/async-upload.php","filters":{"max_file_size":"2097152b","mime_types":[{"extensions":"jpg,jpeg,jpe,gif,png,bmp,tiff,tif,ico,asf,asx,wmv,wmx,wm,avi,divx,flv,mov,qt,mpeg,mpg,mpe,mp4,m4v,ogv,webm,mkv,3gp,3gpp,3g2,3gp2,txt,asc,c,cc,h,srt,csv,tsv,ics,rtx,css,vtt,dfxp,mp3,m4a,m4b,aac,ra,ram,wav,ogg,oga,flac,mid,midi,wma,wax,mka,rtf,pdf,class,tar,zip,gz,gzip,rar,7z,psd,xcf,doc,pot,pps,ppt,wri,xla,xls,xlt,xlw,mdb,mpp,docx,docm,dotx,dotm,xlsx,xlsm,xlsb,xltx,xltm,xlam,pptx,pptm,ppsx,ppsm,potx,potm,ppam,sldx,sldm,onetoc,onetoc2,onetmp,onepkg,oxps,xps,odt,odp,ods,odg,odc,odb,odf,wp,wpd,key,numbers,pages"}]},"multipart_params":{"action":"upload-attachment","_wpnonce":"0e3b589a6f"}},"browser":{"mobile":false,"supported":true},"limitExceeded":false};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/plupload/wp-plupload.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/mouse.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/jquery/ui/sortable.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/mediaelement/wp-mediaelement.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wpApiSettings = {"root":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-json\/","nonce":"3a82b810ee","versionString":"wp\/v2\/"};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/api-request.min.js') }}'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpMediaViewsL10n = {"url":"URL","addMedia":"Add Media","search":"Search","select":"Select","cancel":"Cancel","update":"Update","replace":"Replace","remove":"Remove","back":"Back","selected":"%d selected","dragInfo":"Drag and drop to reorder media files.","uploadFilesTitle":"Upload Files","uploadImagesTitle":"Upload Images","mediaLibraryTitle":"Media Library","insertMediaTitle":"Add Media","createNewGallery":"Create a new gallery","createNewPlaylist":"Create a new playlist","createNewVideoPlaylist":"Create a new video playlist","returnToLibrary":"\u2190 Return to library","allMediaItems":"All media items","allDates":"All dates","noItemsFound":"No items found.","insertIntoPost":"Insert into post","unattached":"Unattached","mine":"Mine","trash":"Trash","uploadedToThisPost":"Uploaded to this post","warnDelete":"You are about to permanently delete this item from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkDelete":"You are about to permanently delete these items from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkTrash":"You are about to trash these items.\n  'Cancel' to stop, 'OK' to delete.","bulkSelect":"Bulk Select","trashSelected":"Move to Trash","restoreSelected":"Restore from Trash","deletePermanently":"Delete Permanently","apply":"Apply","filterByDate":"Filter by date","filterByType":"Filter by type","searchMediaLabel":"Search Media","searchMediaPlaceholder":"Search media items...","noMedia":"No media files found.","attachmentDetails":"Attachment Details","insertFromUrlTitle":"Insert from URL","setFeaturedImageTitle":"Featured Image","setFeaturedImage":"Set featured image","createGalleryTitle":"Create Gallery","editGalleryTitle":"Edit Gallery","cancelGalleryTitle":"\u2190 Cancel Gallery","insertGallery":"Insert gallery","updateGallery":"Update gallery","addToGallery":"Add to gallery","addToGalleryTitle":"Add to Gallery","reverseOrder":"Reverse order","imageDetailsTitle":"Image Details","imageReplaceTitle":"Replace Image","imageDetailsCancel":"Cancel Edit","editImage":"Edit Image","chooseImage":"Choose Image","selectAndCrop":"Select and Crop","skipCropping":"Skip Cropping","cropImage":"Crop Image","cropYourImage":"Crop your image","cropping":"Cropping\u2026","suggestedDimensions":"Suggested image dimensions: %1$s by %2$s pixels.","cropError":"There has been an error cropping your image.","audioDetailsTitle":"Audio Details","audioReplaceTitle":"Replace Audio","audioAddSourceTitle":"Add Audio Source","audioDetailsCancel":"Cancel Edit","videoDetailsTitle":"Video Details","videoReplaceTitle":"Replace Video","videoAddSourceTitle":"Add Video Source","videoDetailsCancel":"Cancel Edit","videoSelectPosterImageTitle":"Select Poster Image","videoAddTrackTitle":"Add Subtitles","playlistDragInfo":"Drag and drop to reorder tracks.","createPlaylistTitle":"Create Audio Playlist","editPlaylistTitle":"Edit Audio Playlist","cancelPlaylistTitle":"\u2190 Cancel Audio Playlist","insertPlaylist":"Insert audio playlist","updatePlaylist":"Update audio playlist","addToPlaylist":"Add to audio playlist","addToPlaylistTitle":"Add to Audio Playlist","videoPlaylistDragInfo":"Drag and drop to reorder videos.","createVideoPlaylistTitle":"Create Video Playlist","editVideoPlaylistTitle":"Edit Video Playlist","cancelVideoPlaylistTitle":"\u2190 Cancel Video Playlist","insertVideoPlaylist":"Insert video playlist","updateVideoPlaylist":"Update video playlist","addToVideoPlaylist":"Add to video playlist","addToVideoPlaylistTitle":"Add to Video Playlist","attachmentsList":"Attachments list","settings":{"tabs":[],"tabUrl":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-admin\/media-upload.php?chromeless=1","mimeTypes":{"image":"Images","audio":"Audio","video":"Video"},"captions":true,"nonce":{"sendToEditor":"776f69d969"},"post":{"id":0},"defaultProps":{"link":"file","align":"","size":""},"attachmentCounts":{"audio":1,"video":1},"oEmbedProxyUrl":"https:\/\/demos.alkalab.com\/woffice\/business\/wp-json\/oembed\/1.0\/proxy","embedExts":["mp3","ogg","flac","m4a","wav","mp4","m4v","webm","ogv","flv"],"embedMimes":{"mp3":"audio\/mpeg","ogg":"audio\/ogg","flac":"audio\/flac","m4a":"audio\/mpeg","wav":"audio\/wav","mp4":"video\/mp4","m4v":"video\/mp4","webm":"video\/webm","ogv":"video\/ogg","flv":"video\/x-flv"},"contentWidth":null,"months":[{"year":"2018","month":"12","text":"December 2018"},{"year":"2017","month":"6","text":"June 2017"},{"year":"2017","month":"5","text":"May 2017"}],"mediaTrash":0}};
    /* ]]> */
</script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/media-views.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/media-editor.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/media-audiovideo.min.js') }}'></script>
<script type='text/javascript' src='{{ asset('site/theme/wp-includes/js/wp-embed.min.js') }}'></script>
<!-- JAVSCRIPTS BELOW AND FILES LOADED BY WORDPRESS -->
<script type="text/javascript">
    var loader = null;
    if (jQuery('#success-register').length > 0) {
        loader = new Woffice.loader(jQuery('.login-tabs-wrapper'));
        jQuery("#register-form, #goback-trigger").hide();
        jQuery("#loginform, #register-wrapper,a.password-lost").hide();
        setTimeout(function() {
            show_login(loader);
            jQuery("#register-wrapper").hide();
        }, 2000);
    }

    jQuery("#register-loader, #register-form, #goback-trigger").hide();
    jQuery("#register-trigger").on('click', function(){
        show_register();
    });
    jQuery("#goback-trigger a").on('click', function(){
        loader = new Woffice.loader(jQuery('.login-tabs-wrapper'));
        jQuery("#register-form, #goback-trigger").hide();
        setTimeout(function() {
            show_login(loader);
        }, 1000);
    });
    var hash = location.hash.replace('#', '').toString();
    if (hash === 'register-form') {
        if (jQuery('#success-register').length  == 0) {
            show_register();
        }
    }

    function show_login( loader = null ) {
        jQuery("#loginform, .social-login-btns, #register-wrapper,a.password-lost").show();
        if( loader != null ) {
            loader.remove();
            loader = null;
        }
    }
    function show_register( ) {
        loader = new Woffice.loader(jQuery('.login-tabs-wrapper'));
        jQuery("#loginform, .social-login-btns, #register-wrapper,a.password-lost").hide();
        setTimeout(function() {
            jQuery("#register-form, #goback-trigger").show();
            loader.remove();
        }, 1000);
    }
</script>