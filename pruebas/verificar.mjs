/**
 * Corre las comprobaciones de sistema, descubriéndolas.
 *
 * Agregar un archivo a pruebas/sistema/ alcanza para que corra, y
 * pruebas/sistema/gobernanza.mjs comprueba que ninguno quede fuera.
 *
 *   npm run verificar
 */

import { spawnSync } from 'node:child_process';
import { comprobaciones } from './catalogo.mjs';
import { TEMA } from './comun.mjs';

console.log( 'Comprobaciones de sistema' );

let malas = 0;
for ( const archivo of comprobaciones().sistema ) {
  const r = spawnSync( process.execPath, [ `pruebas/${ archivo }` ], { cwd: TEMA, stdio: 'inherit' } );
  if ( r.status !== 0 ) malas++;
}

process.exit( malas ? 1 : 0 );
