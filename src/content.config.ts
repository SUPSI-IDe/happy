// Collezioni di contenuti. Ogni tipo è descritto in docs/ontology.md; qui c'è solo quello che serve al codice.
import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

const partner = defineCollection({
	loader: glob({ pattern: '*.json', base: './src/content/partner' }),
	schema: z.object({
		nome: z.string(),
		// Il logo si aggiunge quando i file sono pronti
		link: z.url().optional(),
		ordine: z.number(),
	}),
});

export const collections = { partner };
