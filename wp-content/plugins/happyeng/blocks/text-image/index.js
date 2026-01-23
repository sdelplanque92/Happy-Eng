import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, InspectorControls, RichText, MediaUpload, MediaUploadCheck } from "@wordpress/block-editor";
import { PanelBody, Button, TextControl } from "@wordpress/components";

registerBlockType("he/text-image-composition", {
    edit: ({ attributes, setAttributes }) => {
        const { title, mediaId, mediaUrl, mediaAlt, text } = attributes;
        const blockProps = useBlockProps({ className: "he-comp-editor" });

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
                    <PanelBody title="Réglages">
                        <TextControl
                            label="Texte alternatif (alt)"
                            value={mediaAlt}
                            onChange={(v) => setAttributes({ mediaAlt: v })}
                            help="Important pour l’accessibilité et le SEO."
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
                    <div className="he-comp__container">
                        <RichText
                            tagName="h2"
                            className="he-comp__title"
                            placeholder="Ton titre…"
                            value={title}
                            onChange={(v) => setAttributes({ title: v })}
                            allowedFormats={[]}
                        />

                        <div className="he-comp__row">
                            <div className="he-comp__text">
                                <RichText
                                    tagName="div"
                                    multiline="p"
                                    placeholder="Ton texte…"
                                    value={text}
                                    onChange={(v) => setAttributes({text: v})}
                                    allowedFormats={["core/bold", "core/italic", "core/link"]}
                                />
                            </div>
                            <div className="he-comp__media">
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={onSelectImage}
                                        allowedTypes={["image"]}
                                        value={mediaId}
                                        render={({open}) => (
                                            <div>
                                                {mediaUrl ? (
                                                    <>
                                                        <img className="he-comp__img" src={mediaUrl}
                                                             alt={mediaAlt || ""}/>
                                                        <div style={{marginTop: 8}}>
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
                        </div>
                    </div>
                </section>
            </>
        );
    },

    save: () => null // bloc dynamique => rendu PHP
});