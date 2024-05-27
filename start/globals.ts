import edge from 'edge.js'

import { icons as heroIcons } from '@iconify-json/heroicons'
import { icons as phIcons } from '@iconify-json/ph'
import { addCollection, edgeIconify } from 'edge-iconify'

/**
 * Add Icons collection
 */
addCollection(phIcons)
addCollection(heroIcons)

/**
 * Register the plugin
 */
edge.use(edgeIconify)

edge.global('globalExample', 'Global Info')
