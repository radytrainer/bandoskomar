( function( api ) {

	// Extends our custom "charity-aid" section.
	api.sectionConstructor['charity-aid'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );