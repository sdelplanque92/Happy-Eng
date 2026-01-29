import { registerBlockType } from "@wordpress/blocks";
import {
    useBlockProps,
    InspectorControls,
    RichText,
    MediaUpload,
    MediaUploadCheck,
    InnerBlocks
} from "@wordpress/block-editor";
import { PanelBody, Button, TextControl } from "@wordpress/components";

registerBlockType("he/text-image-bullets", {
    edit: ({ attributes, setAttributes }) => {
        const { title, text, mediaId, mediaUrl, mediaAlt } = attributes;

        const blockProps = useBlockProps({ className: "he-tib-editor" });

        const onSelectImage = (media) => {
            setAttributes({
                mediaId: media?.id || 0,
                mediaUrl: media?.url || "",
                mediaAlt: media?.alt || ""
            });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Image">
                        <TextControl
                            label="Texte alternatif (alt)"
                            value={mediaAlt}
                            onChange={(v) => setAttributes({ mediaAlt: v })}
                            help="Accessibilité & SEO."
                        />
                        {mediaUrl ? (
                            <Button
                                variant="secondary"
                                onClick={() => setAttributes({ mediaId: 0, mediaUrl: "", mediaAlt: "" })}
                            >
                                Retirer l’image
                            </Button>
                        ) : null}
                    </PanelBody>
                </InspectorControls>

                <section {...blockProps}>
                    <div className="he-tib__container">
                        <RichText
                            tagName="h2"
                            className="he-tib__title"
                            placeholder="Titre…"
                            value={title}
                            onChange={(v) => setAttributes({ title: v })}
                            allowedFormats={[]}
                        />

                        <RichText
                            tagName="p"
                            className="he-tib__text"
                            placeholder="Texte… (Entrée = retour à la ligne)"
                            value={text}
                            onChange={(v) => setAttributes({ text: v })}
                            allowedFormats={["core/bold", "core/italic", "core/link"]}
                        />

                        <div className="he-tib__row">
                            {/* GAUCHE : IMAGE */}
                            <div className="he-tib__left">
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={onSelectImage}
                                        allowedTypes={["image"]}
                                        value={mediaId}
                                        render={({ open }) => (
                                            <div>
                                                {mediaUrl ? (
                                                    <>
                                                        <img className="he-tib__img" src={mediaUrl} alt={mediaAlt || ""} />
                                                        <div style={{ marginTop: 8 }}>
                                                            <Button variant="primary" onClick={open}>
                                                                Changer l’image
                                                            </Button>
                                                        </div>
                                                    </>
                                                ) : (
                                                    <Button variant="primary" onClick={open}>
                                                        Choisir une image
                                                    </Button>
                                                )}
                                            </div>
                                        )}
                                    />
                                </MediaUploadCheck>
                            </div>

                            {/* DROITE : BULLET LIST (bloc existant) */}
                            <div className="he-tib__right">
                                <InnerBlocks
                                    allowedBlocks={["he/bullet-list"]}
                                    template={[["he/bullet-list"]]}
                                    templateLock="all"
                                />
                            </div>
                        </div>
                    </div>
                </section>
            </>
        );
    },

    // IMPORTANT : sinon $content est vide dans render.php
    save: () => <InnerBlocks.Content />
});
