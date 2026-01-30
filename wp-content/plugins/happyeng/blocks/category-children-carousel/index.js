import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, InspectorControls, RichText } from "@wordpress/block-editor";
import { PanelBody, SelectControl, ToggleControl } from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";

registerBlockType("he/category-children-carousel", {
    edit: ({ attributes, setAttributes }) => {
        const { title, parentTermId, hideEmpty } = attributes;
        const blockProps = useBlockProps({ className: "he-catcar-editor" });

        const categories = useSelect((select) => {
            const { getEntityRecords } = select(coreDataStore);
            return getEntityRecords("taxonomy", "category", {
                per_page: 100,
                orderby: "name",
                order: "asc"
            });
        }, []);

        const options = [
            { label: "— Choisir une catégorie —", value: 0 },
            ...(categories || []).map((t) => ({ label: t.name, value: t.id }))
        ];

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Source">
                        <SelectControl
                            label="Catégorie parent"
                            value={parentTermId}
                            options={options}
                            onChange={(v) => setAttributes({ parentTermId: Number(v) })}
                            help="Le carrousel affichera les catégories ENFANTS de ce terme."
                        />
                        <ToggleControl
                            label="Masquer les catégories vides"
                            checked={!!hideEmpty}
                            onChange={(v) => setAttributes({ hideEmpty: !!v })}
                        />
                    </PanelBody>
                </InspectorControls>

                <section {...blockProps}>
                    <RichText
                        tagName="h2"
                        placeholder="Titre (optionnel)…"
                        value={title}
                        onChange={(v) => setAttributes({ title: v })}
                        allowedFormats={[]}
                    />

                    <p style={{ opacity: 0.8 }}>
                        {parentTermId
                            ? `Affichera les catégories enfants de l’ID ${parentTermId} en carrousel.`
                            : "Choisis une catégorie parent dans la sidebar."}
                    </p>
                </section>
            </>
        );
    },

    save: () => null // bloc dynamique
});
